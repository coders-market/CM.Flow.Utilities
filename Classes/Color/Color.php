<?php
namespace CM\Flow\Utilities\Color;

class Color {
	const FORMAT_RGBA = 0;
	const FORMAT_HEX = 1;

	public $r = 0;
    public $g = 0;
    public $b = 0;
    public $a = 1;

	/**
	* All values are floats from 0 to 1 
	*
	* @param float|Color $r
	* @param float $g
	* @param float $b
    * @param float $a
	*/
	public function __construct($r = 0.0, $g = 0.0, $b = 0.0, $a = 1.0) {
        if($r instanceof Color) {
            $this->r = $r->r;
            $this->g = $r->g;
            $this->b = $r->b;
            $this->a = $r->a;
            
            return;
        }
        
		$this->r = $r;
		$this->g = $g;
		$this->b = $b;
		$this->a = $a;
	}

	public function toString($format = self::FORMAT_RGBA) {
		switch($format) {
			case self::FORMAT_HEX:
				return '#';
			case self::FORMAT_RGBA:
            default:
				return 'rgba(' . round($this->r * 255) . ',' . round($this->g * 255) . ',' . round($this->b * 255) . ',' . number_format($this->a,3,'.','') . ')';
		}
	}

    /**
     *
     * @param float $h hue: value between 0 and 360
     * @param float $s saturation: value between 0 and 1
     * @param float $v value: value between 0 and 1
     * @return Color
     */
	public static function fromHSV($h = 0.0,$s = 1.0,$v = 1.0) {
		if($s <= 0) {
			return new Color($v,$v,$v);
		}

		$hh = $h;
		if($hh >= 360) {
			$hh = 0;
		}
		$hh /= 60;
		$i = intval($hh);

		$ff = $hh - $i;

		$p = $v * (1 - $s);
		$q = $v * (1 - ($s * $ff));
		$t = $v * (1 - ($s * (1 - $ff)));

		switch ($i) {
			case 0:
				return new Color($v,$t,$p);
			case 1:
				return new Color($q,$v,$p);
			case 2:
				return new Color($p,$v,$t);
			case 3:
				return new Color($p,$q,$v);
			case 4:
				return new Color($t,$p,$v);
			case 5:
			default:
				return new Color($v,$p,$q);
				break;
		}
	}
}