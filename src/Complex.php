<?php

declare(strict_types=1);

namespace RB\Math;

final class Complex {

	protected	$real,
				$imag;

	public function __construct(float $real = NULL, float $imag = NULL) {
		$this->real = $real ?? 0;
		$this->imag = $imag ?? 0;
	} // end of the '__construct()' constructor

	public function __toString() : string {
		return sprintf('complex(%s%si*%s)', $this->real, $this->imag < 0 ? '-' : '+', abs($this->imag));
	} // end of the '__toString()' method

	public function __get(string $varname) : mixed {
		switch ($varname) {
			case 'real':
			case 'imag':
				return $this->$varname;
			default:
				throw new \Exception(sprintf('%s(): Unable to access the object property: \'%s::%s\'', __METHOD__, get_class($this), $varname));
		} // end switch
	} // end of the '__get()' method

	public function __set(string $varname, mixed $value) : void {
		switch ($varname) {
			case 'real':
			case 'imag':
				$this->$varname = (float) $value;
				break;
			default:
				throw new \Exception(sprintf('%s(): Unable to access the object property: \'%s::%s\'', __METHOD__, get_class($this), $varname));
		} // end switch
	} // end of the '__set()' method

	public function add(self $y) : self {
		$result = new self;
		$result->real = $this->real + $y->real;
		$result->imag = $this->imag + $y->imag;
		return $result;
	} // end of the 'add()' method

	public function sub(self $y) : self {
		$result = new self;
		$result->real = $this->real - $y->real;
		$result->imag = $this->imag - $y->imag;
		return $result;
	} // end of the 'sub()' method

	public function mul(self $y) : self {
		$result = new self;
		$result->real = $this->real * $y->real - $this->imag * $y->imag;
		$result->imag = $this->imag * $y->real + $this->real * $y->imag;
		return $result;
	} // end of the 'mul()' method

	public function div(self $y) : self {
		$result = new self;
		$tmp = $this->real * $this->real + $this->imag * $this->imag;
		if ($tmp == 0.0) {
			throw new \Exception(sprintf('%s(): Division by zero', __METHOD__));
		} // end if
		$result->real = ($this->real * $y->real + $this->imag * $y->imag) / $tmp;
		$result->imag = ($this->real * $y->imag - $this->imag * $y->real) / $tmp;
		return $result;
	} // end of the 'div()' method

	public function pow(int $n) : self {
		$n = abs($n);
		$result = new self;
		$pow_mod = pow($this->abs(), $n);
		$phi_mul_n = $this->phi() * $n;
		$result->real = $pow_mod * cos($phi_mul_n);
		$result->imag = $pow_mod * sin($phi_mul_n);
		return $result;
	} // end of the 'pow' method

	public function sqrt() : self {
		$result = new self;
		if (!empty($this->real) || !empty($this->imag)) {
			$real = abs($this->real);
			$imag = abs($this->imag);
			if (empty($real)) {
				$abs = $imag;
			} elseif (empty($imag)) {
				$abs = $real;
			} else {
				$abs = sqrt($real * $real + $imag * $imag);
			} // end if
			$result->real = sqrt(($abs + $this->real) * 0.5);
			$result->imag = sqrt(($abs - $this->real) * 0.5);
			if ($this->imag < 0.0) {
				$result->imag = -$result->imag;
			} // end if
		} // end if
		return $result;
	} // end of the 'sqrt()' method

	public function exp() : self {
		$result = new self;
		$er = exp($this->real);
		$result->real = $er * cos($this->imag);
		$result->imag = $er * sin($this->imag);
		return $result;
	} // end of the 'exp()' method

	public function log(int $k = NULL) : self {
		$k = $k ?? 0;
		$mod = $this->abs();
		if ($mod == 0.0) {
			throw new \Exception(sprintf('%s(): The modulus of a complex number must be non-zero', __METHOD__));
		} // end if
		$result = new self;
		$result->real = log($mod);
		$result->imag = $this->phi() + 2 * M_PI * $k;
		return $result;
	} // end of the 'log()' method

	public function inv() : self {
		$result = new self;
		$result->real =  $this->real;
		$result->imag = -$this->imag;
		return $result;
	} // end of the 'inv()' method

	public function abs() : self {
		if (!empty($this->real) || !empty($this->imag)) {
			$real = abs($this->real);
			$imag = abs($this->imag);
			if (empty($real)) {
				$abs = $imag;
			} elseif (empty($imag)) {
				$abs = $real;
			} else {
				$abs = sqrt($real * $real + $imag * $imag);
			} // end if
			return $abs;
		} // end if
		return 0;
	} // end of the 'abs()' method

	public function phi() : float {
		return atan2($this->imag, $this->real);
	} // end of the 'phi()' method

} // end of the 'Complex' class

?>