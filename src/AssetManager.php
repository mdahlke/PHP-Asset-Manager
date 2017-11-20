<?php

namespace AssetManager;

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 7/7/17
 * Time: 1:26 PM
 */

class AssetManager {
	private static $jsFiles = [ 'head' => [], 'footer' => [] ];
	private static $cssFiles = [ 'head' => [], 'footer' => [] ];
	private static $jsScripts = [];
	private static $cssStyle = [];
	
	/**
	 * @return array
	 */
	public static function getJsFiles() {
		if ( empty( self::$jsFiles ) ) {
			self::$jsFiles = [
				'head'   => [],
				'footer' => [],
			];
		}
		
		return self::$jsFiles;
	}
	
	public static function outputJsFiles( $location = 'head' ) {
		$files = self::getJsFiles();
		
		$output = '';
		foreach ( $files[ $location ] as $handle => $attrs ) {
			$output .= '<script src="' . $attrs['src'] . '?tv=' . time() . '"></script>';
		}
		
		echo $output;
	}
	
	/**
	 * @param array $jsFiles
	 */
	private static function setJsFiles( $jsFiles ) {
		self::$jsFiles = $jsFiles;
	}
	
	public static function addJsFile( $handle, $src, $dependencies = '', $inFooter = false ) {
		$jsFiles  = self::getJsFiles();
		$location = $inFooter ? 'footer' : 'head';
		
		$jsFiles[ $location ][ $handle ] = [
			'src'          => $src,
			'dependencies' => $dependencies,
		];
		
		self::setJsFiles( $jsFiles );
	}
	
	/**
	 * @return array
	 */
	public static function getCssFiles() {
		return self::$cssFiles;
	}
	
	public static function outputCssFiles( $location = 'head' ) {
		$files = self::getCssFiles();
		
		$output = '';
		foreach ( $files[ $location ] as $handle => $attrs ) {
			$output .= '<link href="' . $attrs['src'] . '?tv=' . time() . '" rel="stylesheet"/>';
		}
		
		echo $output;
	}
	
	/**
	 * @param array $cssFiles
	 */
	public static function setCssFiles( $cssFiles ) {
		self::$cssFiles = $cssFiles;
	}
	
	public static function addCssFile( $handle, $src, $dependencies = '', $inFooter = false ) {
		$cssFiles = self::getCssFiles();
		$location = $inFooter ? 'footer' : 'head';
		
		$cssFiles[ $location ][ $handle ] = [
			'src'          => $src,
			'dependencies' => $dependencies,
		];
		
		self::setCssFiles( $cssFiles );
	}
	
	
	/**
	 * @return array|string
	 */
	public static function getJsScripts( $implode = false ) {
		return $implode ? implode( '; ', self::$jsScripts ) : self::$jsScripts;
	}
	
	/**
	 * @param array $jsScripts
	 */
	public static function setJsScripts( $jsScripts ) {
		self::$jsScripts = $jsScripts;
	}
	
	public static function addJsScript( $script ) {
		$scripts = self::getJsScripts();
		
		$scripts[] = $script;
		
		self::setJsScripts( $scripts );
	}
	
	/**
	 * @return array
	 */
	public static function getCssStyle() {
		return self::$cssStyle;
	}
	
	/**
	 * @param array $cssStyle
	 */
	public static function setCssStyle( $cssStyle ) {
		self::$cssStyle = $cssStyle;
	}
	
}