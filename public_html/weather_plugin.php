<?php

class weather_plugin {

	function __construct() {
		$this->lang = false; // you can set a default language here
		$this->unit = false; // set default unit of measurement
	}

	function all($location, $city=true, $unit='f', $lang='en') {

		if ($this->lang!=false) {
			$lang=$this->lang;
		}

		if ($this->unit!=false) {
			$unit=$this->unit;
		}

		$location = str_replace(' ', '+', $location);
		$url = 'http://www.google.com/ig/api?weather='.$location.'&hl='.$lang;
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		$data = curl_exec($ch);
		curl_close($ch);

		$data = utf8_encode($data);

		$xml = new SimpleXmlElement($data, LIBXML_NOCDATA);

		if ($xml->weather->forecast_information) {
		// Current conditions
		$weather['current']['city'] = $xml->weather->forecast_information->city['data'];
		$weather['current']['condition'] = $xml->weather->current_conditions->condition['data'];
		$weather['current']['temp_f'] = $xml->weather->current_conditions->temp_f['data'];
		$weather['current']['temp_c'] = $xml->weather->current_conditions->temp_c['data'];
		$weather['current']['humidity'] = $xml->weather->current_conditions->humidity['data'];
//		$weather['current']['icon'] = $xml->weather->current_conditions->icon['data'];
		$weather['current']['icon'] = 'http://www.google.com'.$xml->weather->current_conditions->icon['data'];
		$weather['current']['wind_condition'] = $xml->weather->current_conditions->wind_condition['data'];
	
		// Forecast conditions 1
		$weather['forecast1']['day_of_week'] = $xml->weather->forecast_conditions[0]->day_of_week['data'];
		$weather['forecast1']['low'] = $xml->weather->forecast_conditions[0]->low['data'];
		$weather['forecast1']['high'] = $xml->weather->forecast_conditions[0]->high['data'];
//		$weather['forecast1']['icon'] = $xml->weather->forecast_conditions[0]->icon['data'];
		$weather['forecast1']['icon'] = 'http://www.google.com'.$xml->weather->forecast_conditions[0]->icon['data'];
		$weather['forecast1']['condition'] = $xml->weather->forecast_conditions[0]->condition['data'];
	
		// Forecast conditions 2
		$weather['forecast2']['day_of_week'] = $xml->weather->forecast_conditions[1]->day_of_week['data'];
		$weather['forecast2']['low'] = $xml->weather->forecast_conditions[1]->low['data'];
		$weather['forecast2']['high'] = $xml->weather->forecast_conditions[1]->high['data'];
		$weather['forecast2']['icon'] = 'http://www.google.com'.$xml->weather->forecast_conditions[1]->icon['data'];
//		$weather['forecast2']['icon'] = $xml->weather->forecast_conditions[1]->icon['data'];
		$weather['forecast2']['condition'] = $xml->weather->forecast_conditions[1]->condition['data'];

		// Forecast conditions 3
		$weather['forecast3']['day_of_week'] = $xml->weather->forecast_conditions[2]->day_of_week['data'];
		$weather['forecast3']['low'] = $xml->weather->forecast_conditions[2]->low['data'];
		$weather['forecast3']['high'] = $xml->weather->forecast_conditions[2]->high['data'];
//		$weather['forecast3']['icon'] = $xml->weather->forecast_conditions[2]->icon['data'];
		$weather['forecast3']['icon'] = 'http://www.google.com'.$xml->weather->forecast_conditions[2]->icon['data'];
		$weather['forecast3']['condition'] = $xml->weather->forecast_conditions[2]->condition['data'];

		// Forecast conditions 4
		$weather['forecast4']['day_of_week'] = $xml->weather->forecast_conditions[3]->day_of_week['data'];
		$weather['forecast4']['low'] = $xml->weather->forecast_conditions[3]->low['data'];
		$weather['forecast4']['high'] = $xml->weather->forecast_conditions[3]->high['data'];
//		$weather['forecast4']['icon'] = $xml->weather->forecast_conditions[3]->icon['data'];
		$weather['forecast4']['icon'] = 'http://www.google.com'.$xml->weather->forecast_conditions[3]->icon['data'];
		$weather['forecast4']['condition'] = $xml->weather->forecast_conditions[3]->condition['data'];

		if (strtolower($unit)=='c' || strtolower($unit)=='celsius') {
			$current_temp=$weather['current']['temp_c'].' &deg;C &nbsp;';
		} else {
			$current_temp=$weather['current']['temp_f'].' &deg;F &nbsp;';
		}

			$display = '<div class="weather_container">'
			.'<img src="'.$weather['current']['icon'].'" alt="'.$weather['current']['condition'].'" class="weather_icon" />'
			.'<div class="weather_temperature">'.$current_temp.$weather['current']['condition'].'</div><!-- End # -->'
			.'<span class="weather_wind">'.$weather['current']['wind_condition'].'</span>'
			.'</div>'

			.'<div class="clear_weather">&nbsp;</div>'

			.'<div class="forecast_container">'
			.'<div class="weather_day_forecast">'.$weather['forecast1']['day_of_week'].'</div>'
			.'<img src="'.$weather['forecast1']['icon'].'" alt="'.$weather['forecast1']['condition'].'" class="weather_icon_forecast" /><br />'
			.'<span class="weather_high">'.$weather['forecast1']['high'].'&deg;</span>&nbsp;<span class="weather_low">'.$weather['forecast1']['low'].'&deg;</span>'
			.'</div>'

			.'<div class="forecast_container">'
			.'<div class="weather_day_forecast">'.$weather['forecast2']['day_of_week'].'</div>'
			.'<img src="'.$weather['forecast2']['icon'].'" alt="'.$weather['forecast2']['condition'].'" class="weather_icon_forecast" /><br />'
			.'<span class="weather_high">'.$weather['forecast2']['high'].'&deg;</span>&nbsp;<span class="weather_low">'.$weather['forecast2']['low'].'&deg;</span>'
			.'</div>'

			.'<div class="forecast_container">'
			.'<div class="weather_day_forecast">'.$weather['forecast3']['day_of_week'].'</div>'
			.'<img src="'.$weather['forecast3']['icon'].'" alt="'.$weather['forecast3']['condition'].'" class="weather_icon_forecast" /><br />'
			.'<span class="weather_high">'.$weather['forecast3']['high'].'&deg;</span>&nbsp;<span class="weather_low">'.$weather['forecast3']['low'].'&deg;</span>'
			.'</div>'

			.'<div class="forecast_container">'
			.'<div class="weather_day_forecast">'.$weather['forecast4']['day_of_week'].'</div>'
			.'<img src="'.$weather['forecast4']['icon'].'" alt="'.$weather['forecast4']['condition'].'" class="weather_icon_forecast" /><br />'
			.'<span class="weather_high">'.$weather['forecast4']['high'].'&deg;</span>&nbsp;<span class="weather_low">'.$weather['forecast4']['low'].'&deg;</span>'
			.'</div><div class="clear_weather">&nbsp;</div>';

			if ($city==true || $city=='true') {
				$display = '<div class="weather_city">'.$weather['current']['city'].'</div>'.$display;
			}

			return $display;

		} else {
			return 'Invalid location';
		}

	}

	function now($location, $city=true, $unit='f', $lang='en') {

		if ($this->lang!=false) {
			$lang=$this->lang;
		}

		if ($this->unit!=false) {
			$unit=$this->unit;
		}

		$location = str_replace(' ', '+', $location);
		$url = 'http://www.google.com/ig/api?weather='.$location.'&hl='.$lang;
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		$data = curl_exec($ch);
		curl_close($ch);

		$data = utf8_encode($data);

		$xml = new SimpleXmlElement($data, LIBXML_NOCDATA);

		if ($xml->weather->forecast_information) {
		// Current conditions
		$weather['current']['city'] = $xml->weather->forecast_information->city['data'];
		$weather['current']['condition'] = $xml->weather->current_conditions->condition['data'];
		$weather['current']['temp_f'] = $xml->weather->current_conditions->temp_f['data'];
		$weather['current']['temp_c'] = $xml->weather->current_conditions->temp_c['data'];
		$weather['current']['humidity'] = $xml->weather->current_conditions->humidity['data'];
		$weather['current']['icon'] = 'http://www.google.com'.$xml->weather->current_conditions->icon['data'];
		$weather['current']['wind_condition'] = $xml->weather->current_conditions->wind_condition['data'];
	
		// Forecast conditions 1
		$weather['forecast1']['day_of_week'] = $xml->weather->forecast_conditions[0]->day_of_week['data'];
		$weather['forecast1']['low'] = $xml->weather->forecast_conditions[0]->low['data'];
		$weather['forecast1']['high'] = $xml->weather->forecast_conditions[0]->high['data'];
		$weather['forecast1']['icon'] = 'http://www.google.com'.$xml->weather->forecast_conditions[0]->icon['data'];
		$weather['forecast1']['condition'] = $xml->weather->forecast_conditions[0]->condition['data'];
	
		// Forecast conditions 2
		$weather['forecast2']['day_of_week'] = $xml->weather->forecast_conditions[1]->day_of_week['data'];
		$weather['forecast2']['low'] = $xml->weather->forecast_conditions[1]->low['data'];
		$weather['forecast2']['high'] = $xml->weather->forecast_conditions[1]->high['data'];
		$weather['forecast2']['icon'] = 'http://www.google.com'.$xml->weather->forecast_conditions[1]->icon['data'];
		$weather['forecast2']['condition'] = $xml->weather->forecast_conditions[1]->condition['data'];

		// Forecast conditions 3
		$weather['forecast3']['day_of_week'] = $xml->weather->forecast_conditions[2]->day_of_week['data'];
		$weather['forecast3']['low'] = $xml->weather->forecast_conditions[2]->low['data'];
		$weather['forecast3']['high'] = $xml->weather->forecast_conditions[2]->high['data'];
		$weather['forecast3']['icon'] = 'http://www.google.com'.$xml->weather->forecast_conditions[2]->icon['data'];
		$weather['forecast3']['condition'] = $xml->weather->forecast_conditions[2]->condition['data'];

		// Forecast conditions 4
		$weather['forecast4']['day_of_week'] = $xml->weather->forecast_conditions[3]->day_of_week['data'];
		$weather['forecast4']['low'] = $xml->weather->forecast_conditions[3]->low['data'];
		$weather['forecast4']['high'] = $xml->weather->forecast_conditions[3]->high['data'];
		$weather['forecast4']['icon'] = 'http://www.google.com'.$xml->weather->forecast_conditions[3]->icon['data'];
		$weather['forecast4']['condition'] = $xml->weather->forecast_conditions[3]->condition['data'];

		if (strtolower($unit)=='c' || strtolower($unit)=='celsius') {
			$current_temp=$weather['current']['temp_c'].' &deg;C &nbsp;';
		} else {
			$current_temp=$weather['current']['temp_f'].' &deg;F &nbsp;';
		}

		$display = '<div class="weather_container">
		<img src="'.$weather['current']['icon'].'" alt="'.$weather['current']['condition'].'" class="weather_icon" />
		<div class="weather_temperature">'.$current_temp.$weather['current']['condition'].'</div><!-- End # -->
		<span class="weather_wind">'.$weather['current']['wind_condition'].'</span>
		</div><div class="clear_weather">&nbsp;</div>';

		if ($city==true || $city=='true') {
			$display = '<div class="weather_city">'.$weather['current']['city'].'</div>'.$display;
		}

		return $display;

		} else {
			return 'Invalid location';
		}

	}

	function data($location, $lang='en') {

		if ($this->lang!=false) {
			$lang=$this->lang;
		}

		if ($this->unit!=false) {
			$unit=$this->unit;
		}

		$location = str_replace(' ', '+', $location);
		$url = 'http://www.google.com/ig/api?weather='.$location.'&hl='.$lang;
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		$data = curl_exec($ch);
		curl_close($ch);

		$data = utf8_encode($data);

		$xml = new SimpleXmlElement($data, LIBXML_NOCDATA);

		if ($xml->weather->forecast_information) {
		// Current conditions
		$weather['current']['city'] = $xml->weather->forecast_information->city['data'];
		$weather['current']['condition'] = $xml->weather->current_conditions->condition['data'];
		$weather['current']['temp_f'] = $xml->weather->current_conditions->temp_f['data'];
		$weather['current']['temp_c'] = $xml->weather->current_conditions->temp_c['data'];
		$weather['current']['humidity'] = $xml->weather->current_conditions->humidity['data'];
		$weather['current']['icon'] = 'http://www.google.com'.$xml->weather->current_conditions->icon['data'];
		$weather['current']['wind_condition'] = $xml->weather->current_conditions->wind_condition['data'];
	
		// Forecast conditions 1
		$weather['forecast1']['day_of_week'] = $xml->weather->forecast_conditions[0]->day_of_week['data'];
		$weather['forecast1']['low'] = $xml->weather->forecast_conditions[0]->low['data'];
		$weather['forecast1']['high'] = $xml->weather->forecast_conditions[0]->high['data'];
		$weather['forecast1']['icon'] = 'http://www.google.com'.$xml->weather->forecast_conditions[0]->icon['data'];
		$weather['forecast1']['condition'] = $xml->weather->forecast_conditions[0]->condition['data'];
	
		// Forecast conditions 2
		$weather['forecast2']['day_of_week'] = $xml->weather->forecast_conditions[1]->day_of_week['data'];
		$weather['forecast2']['low'] = $xml->weather->forecast_conditions[1]->low['data'];
		$weather['forecast2']['high'] = $xml->weather->forecast_conditions[1]->high['data'];
		$weather['forecast2']['icon'] = 'http://www.google.com'.$xml->weather->forecast_conditions[1]->icon['data'];
		$weather['forecast2']['condition'] = $xml->weather->forecast_conditions[1]->condition['data'];

		// Forecast conditions 3
		$weather['forecast3']['day_of_week'] = $xml->weather->forecast_conditions[2]->day_of_week['data'];
		$weather['forecast3']['low'] = $xml->weather->forecast_conditions[2]->low['data'];
		$weather['forecast3']['high'] = $xml->weather->forecast_conditions[2]->high['data'];
		$weather['forecast3']['icon'] = 'http://www.google.com'.$xml->weather->forecast_conditions[2]->icon['data'];
		$weather['forecast3']['condition'] = $xml->weather->forecast_conditions[2]->condition['data'];

		// Forecast conditions 4
		$weather['forecast4']['day_of_week'] = $xml->weather->forecast_conditions[3]->day_of_week['data'];
		$weather['forecast4']['low'] = $xml->weather->forecast_conditions[3]->low['data'];
		$weather['forecast4']['high'] = $xml->weather->forecast_conditions[3]->high['data'];
		$weather['forecast4']['icon'] = 'http://www.google.com'.$xml->weather->forecast_conditions[3]->icon['data'];
		$weather['forecast4']['condition'] = $xml->weather->forecast_conditions[3]->condition['data'];

		return $weather;

		} else {
			return 'Invalid location';
		}

	}

}s

$get_weather = new weather_plugin;