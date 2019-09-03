# PHP Dumper

**Version:** 1.0.8 beta

**Github:** https://github.com/marcocesarato/PHP-Dumper

**Author:** Marco Cesarato

## Description

This class can display a formatted version of variable values.

It can take the values of one or more variables and generates a string that displays the variable values in a readable format.

Arrays and objects can be traversed recursively to display its member values.

The class can either return a string with the formatted variable values, display it to the current page or even exit the current script.

## Requirements

- php 4+

## Install

### Composer
1. Install composer
2. Type `composer require marcocesarato/dumper`
4. Enjoy

## Usage

```php
use marcocesarato\dumper\Dumper;

$arr = array(1,2,3,4,5);

$dump = Dumper::get($arr, $arr /* , ... */); // Get string of dump
Dumper::out($arr /* , ... */); // Print
Dumper::fatal($arr /* , ... */); // Print and die
```

## Methods

### Dumper

| Method      | Parameters                          | Description                                        |
| ----------- | ----------------------------------- | -------------------------------------------------- |
| get      | 	   mixed $expression [, mixed $... ]<br>return string | Return dump as string  |
| out    |       mixed $expression [, mixed $... ]<br>return void   | Print dump      |
| clean      |    mixed $expression [, mixed $... ]<br>return void  | Clean stream (ob_clean) and print dump |
| json      |    mixed $expression [, mixed $... ]<br>return void  | Clean stream (ob_clean) and print json dump |
| fatal      |   mixed $expression [, mixed $... ]<br>return void  | Print dump and die |
| enableHighlight      |   return void  | Enable Highlight (default true) |
| disableHighlight      |   return void  | Disable Highlight |
| disableHighlight      |   return void  | Disable Highlight |
| getDepth      |   return int  | Get Object/Array dump depth |
| setDepth      |   int $depth<br>return void  | Set Object/Array dump depth |