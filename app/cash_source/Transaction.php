<?php

namespace App\Cash_Source;

interface Transaction
{
	/**
	* Validate Inputs
	*/
	public function validate($amount);
	/**
	* Return total amount
	*/
	public function amount();
	/**
	* Return Inputs
	*/
	public function inputs($amount);

}