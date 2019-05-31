# PHP Dumper

**Version:** 0.1.4 beta

**Github:** https://github.com/marcocesarato/PHP-Dumper

**Author:** Marco Cesarato

## Description

This class displays structured information about one or more expressions that includes its type and value. Arrays and objects are explored recursively with values indented to show structure.

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
| out    |       mixed $expression [, mixed $... ]<br>return string   | Print dump      |
| get      | 	   mixed $expression [, mixed $... ]<br>return void | Return dump as string  |
| clean      |    mixed $expression [, mixed $... ]<br>return void  | Clean stream (ob_clean) and print dump |
| fatal      |   mixed $expression [, mixed $... ]<br>return void  | Print dump and die |
| enableHighlight      |   return void  | Enable Highlight (default true) |
| disableHighlight      |   return void  | Disable Highlight |
| disableHighlight      |   return void  | Disable Highlight |
| getDepth      |   return int  | Get Object/Array dump depth |
| setDepth      |   int $depth<br>return void  | Set Object/Array dump depth |