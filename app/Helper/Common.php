<?php

namespace App\Helper;

use Illuminate\Pagination\LengthAwarePaginator;
class Common
{
		
		static function amountToWords( $amount )
		{
				$ones = [ 'Zero', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine' ];
				$teens = [ 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen' ];
				$tens = [ 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety' ];
				$thousands = [ '', 'Thousand', 'Million', 'Billion' ];
				if( $amount == 0 ) {
						return $ones[ 0 ] . '/-';
				}
				$words = '';
				if( $amount < 0 ) {
						$words = 'Negative ';
						$amount = abs( $amount );
				}
				for( $i = 0; $amount > 0; $i++ ) {
						if( $amount % 1000 != 0 ) {
								$words = self::convertLessThanThousand( $amount % 1000, $ones, $teens,
												$tens ) . ( $words ? ' ' : '' ) . $thousands[ $i ] . ( $thousands[ $i ] ? ' ' : '' ) . $words;
						}
						$amount = (int) ( $amount / 1000 );
				}
				
				return $words . 'only/-';
		}
		
		// Function to convert a number less than 1000 to words
		static function convertLessThanThousand( $num, $ones, $teens, $tens )
		{
				if( $num == 0 ) {
						return '';
				} elseif( $num < 10 ) {
						return $ones[ $num ];
				} elseif( $num < 20 ) {
						return $teens[ $num - 11 ];
				} elseif( $num < 100 ) {
						return $tens[ $num / 10 - 1 ] . ( $num % 10 == 0 ? ' ' : '-' . $ones[ $num % 10 ] );
				} else {
						return $ones[ $num / 100 ] . ' Hundred' . ( $num % 100 == 0 ? ' ' : ' ' . self::convertLessThanThousand( $num % 100,
												$ones, $teens, $tens ) );
				}
		}
		
		
		static function showPerPage( $perPage, $model )
		{
				// Paginate the retrieved 50 records in sets of 10 per page
				// Paginate the retrieved 50 records in sets of 10 per page manually
				$currentPage = LengthAwarePaginator::resolveCurrentPage();
				$currentItems = $model->slice( ( $currentPage - 1 ) * $perPage, $perPage )->all();
				
				return new LengthAwarePaginator( $currentItems, count( $model ), $perPage );
		}
		
}