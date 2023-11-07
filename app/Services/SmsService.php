<?php
		
		namespace App\Services;
		
		use Illuminate\Http\Client\RequestException;
		use Illuminate\Support\Facades\Http;
		class SmsService
		{
				
				
				private $client;
				
				public function __construct()
				{
						/**
							* Outreach
							*/
						$this->client = Http::baseUrl( 'http://outreach.pk/api/sendsms.php/' );
				}
				
				/**
					* @param $phone
					* @param $message
					* @return array|mixed|void
					* @throws RequestException
					*/
				public function send( $phone, $message )
				{
						
						$phone = ltrim( $phone, '0' );
						if( substr( $phone, 0, 2 ) !== '92' ) {
								$phone = '92' . $phone;
						}
						$phone = str_replace( '-', '', $phone );
						$url = 'sendsms/url';
						$params = [
								'id'   => env( 'SMSID' ),
								'pass' => env( 'SMSPASS' ),
								'mask' => env( 'SMSMASK' ),
								'to'   => $phone,
								'lang' => 'English',
								'msg'  => $message,
								'type' => 'json'
						];
						$response = $this->client->acceptJson()->get( $url, $params );
						if( $response->successful() ) {
								return $response->json();
						}
						
						return $response->throw();
				}
				
				public function sendToAll( $to, $message )
				{
						$url = 'sendsms/url';
						$params = [
								'id'   => env( 'SMSID' ),
								'pass' => env( 'SMSPASS' ),
								'mask' => env( 'SMSMASK' ),
								'to'   => $to,//'92300xxxxxxx',
								'lang' => 'English',
								'msg'  => $message,
								'type' => 'json'
						];
						$response = $this->client->acceptJson()->get( $url, $params );
						if( $response->successful() ) {
								return $response->json();
						}
						
						return $response->throw();
				}
				
				public function checkRemainingSMS()
				{
						$url = 'balance/status';
						$params = [
								'id'   => env( 'SMSID' ),
								'pass' => env( 'SMSPASS' ),
						];
						$response = $this->client->get( $url, $params );
						if( $response->successful() ) {
								return $response;
						}
						
						return $response->throw();
				}
				
				public function deliveryStatus()
				{
						$url = 'delivery/status';
						$params = [
								'id'   => env( 'SMSID' ),
								'pass' => env( 'SMSPASS' ),
						];
						$response = $this->client->get( $url, $params );
						if( $response->successful() ) {
								return $response;
						}
						
						return $response->throw();
				}
				
		}// SmsService
