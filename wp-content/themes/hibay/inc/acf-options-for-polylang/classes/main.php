<?php namespace BEA\ACF_Options_For_Polylang;

class Main {
	/**
	 * Use the trait
	 */
	use Singleton;

	protected function init() {
		// Set the setting's lang
		add_filter( 'acf/validate_post_id', [ $this, 'set_options_id_lang' ], 10, 2 );

		// Set Polylang current lang
		add_filter( 'acf/settings/current_language', [ $this, 'set_current_site_lang' ] );

		// Get default Polylang's option page value
		add_filter( 'acf/load_value', [ $this, 'get_default_value' ], 10, 3 );

		// Help loading right field for repeaters
		add_filter( 'acf/load_reference', [ $this, 'get_default_reference' ], 10, 3 );

		// Plugin's own translations
		add_action( 'init', [ $this, 'init_translations' ] );
	}

	/**
	 * Get the current Polylang's locale or the wp's one
	 *
	 * @author Maxime CULEA
	 *
	 * @return bool|string
	 */
	public function set_current_site_lang() {
		return pll_current_language( 'locale' );
	}

	/**
	 * Load the correct reference for field key in have_rows loops
	 *
	 * @param $reference
	 * @param $field_name
	 * @param $post_id
	 *
	 * @author Jukra, Maxime CULEA
	 *
	 * @since  1.1.2
	 *
	 * @return string
	 */
	public function get_default_reference( $reference, $field_name, $post_id ) {
		if ( ! empty( $reference ) ) {
			return $reference;
		}

		/**
		 * Dynamically get the options page ID
		 * @see : https://regex101.com/r/58uhKg/2/
		 */
		$_post_id = preg_replace( '/(_[a-z]{2}_[A-Z]{2})/', '', $post_id );

		remove_filter( 'acf/load_reference', [ $this, 'get_default_reference' ] );
		$reference = acf_get_reference( $field_name, $_post_id );
		add_filter( 'acf/load_reference', [ $this, 'get_default_reference' ], 10, 3 );

		return $reference;
	}

	/**
	 * Load default value (all languages) in front if none found for an acf option
	 *
	 * @param $value
	 * @param $post_id
	 * @param $field
	 *
	 * @author Maxime CULEA
	 *
	 * @return mixed|string|void
	 */
	public function get_default_value( $value, $post_id, $field ) {
		if ( is_admin() || ! self::is_option_page( $post_id ) ) {
			return $value;
		}

		/**
		 * Activate or deactivate the default value (all languages)
		 *
		 * @since 1.0.2
		 */
		if ( ! apply_filters( 'bea.aofp.get_default', true ) ) {
			return $value;
		}

		/**
		 * According to his type, check the value to be not an empty string.
		 * While false or 0 could be returned, so "empty" method could not be here useful.
		 *
		 * @see   https://github.com/atomicorange : Thx to atomicorange for the issue
		 *
		 * @since 1.0.1
		 */
		if ( ! is_null( $value ) ) {
			if ( is_array( $value ) ) {
				// Get from array all the not empty strings
				$is_empty = array_filter( $value, function ( $value_c ) {
					return "" !== $value_c;
				} );

				if ( ! empty( $is_empty ) ) {
					// Not an array of empty values
					return $value;
				}
			} else {
				if ( "" !== $value ) {
					// Not an empty string
					return $value;
				}
			}
		}

		/**
		 * Delete filters for loading "default" Polylang saved value
		 * and for avoiding infinite looping on current filter
		 */
		remove_filter( 'acf/settings/current_language', [ $this, 'set_current_site_lang' ] );
		remove_filter( 'acf/load_value', [ $this, 'get_default_value' ] );

		/**
		 * Generate the all language option's post_id key
		 *
		 * @since  1.0.2
		 * @author Maxime CULEA
		 */
		$all_language_post_id = str_replace( sprintf( '_%s', pll_current_language( 'locale' ) ), '', $post_id );

		// Get the "All language" value
		$value = acf_get_metadata( $all_language_post_id, $field['name'] );

		/**
		 * Re-add deleted filters
		 */
		add_filter( 'acf/settings/current_language', [ $this, 'set_current_site_lang' ] );
		add_filter( 'acf/load_value', [ $this, 'get_default_value' ], 10, 3 );

		return $value;
	}

	/**
	 * Get all registered options pages as array [ post_id => page title ]
	 *
	 * @since  1.0.2
	 * @author Maxime CULEA
	 *
	 * @return array
	 */
	function get_option_page_ids() {
		if ( ! function_exists( 'acf_get_valid_location_rule' ) ) {
			return [];
		}
		$rule = [
			'param'    => 'options_page',
			'operator' => '==',
			'value'    => 'acf-options',
			'id'       => 'rule_0',
			'group'    => 'group_0',
		];

		$rule          = acf_get_valid_location_rule( $rule );
		$options_pages = acf_get_location_rule_values( $rule );

		return empty( $options_pages ) ? [] : array_keys( $options_pages );
	}

	/**
	 * Check if the given post id is from an options page or not
	 *
	 * @param string $post_id
	 *
	 * @since  1.0.2
	 * @author Maxime CULEA
	 *
	 * @return bool
	 */
	 //////////////////Chí Công////////////////////
	 
 
	 
	 
	 function is_option_page( $post_id ) {
		//$post_id = ""; 
		 
		if ( false !== strpos( $post_id, 'options' ) ) {
			return true;
		}
		$options_pages = $this->get_option_page_ids();
		return ! empty( $options_pages ) && in_array( $post_id, $options_pages );
	} 

	/**
	 * Manage to change the post_id with the current lang to save option against
	 *
	 * @param string $future_post_id
	 * @param string $original_post_id
	 *
	 * @since  1.0.2
	 * @author Maxime CULEA
	 *
	 * @return string
	 */
	function set_options_id_lang( $future_post_id, $original_post_id ) {
		// Only on custom post id option page
		if ( ! self::is_option_page( $original_post_id ) ) {
			return $future_post_id;
		}

		$dl = acf_get_setting( 'default_language' );
		$cl = acf_get_setting( 'current_language' );
		if ( $cl && $cl !== $dl ) {
			$future_post_id .= '_' . $cl;
		}

		return $future_post_id;
	}

	/**
	 * Load the plugin translation
	 */
	public function init_translations() {
		// Load translations
		load_plugin_textdomain( 'bea-acf-options-for-polylang', false, BEA_ACF_OPTIONS_FOR_POLYLANG_PLUGIN_DIRNAME . '/languages' );
	}
}
