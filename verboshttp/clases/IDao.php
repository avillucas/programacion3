<?php 
interface IEntity
{	
	public abstract static function save();
	public abstract static function update(array $data);

}