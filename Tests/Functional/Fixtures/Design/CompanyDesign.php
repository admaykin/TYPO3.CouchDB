<?php
namespace TYPO3\CouchDB\Tests\Functional\Fixtures\Design;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "CouchDB".               *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * A test design document
 *
 * Based on the design document at http://wiki.apache.org/couchdb/HTTP_view_API
 *
 */
class CompanyDesign extends \TYPO3\CouchDB\DesignDocument {

	/**
	 *
	 * @return array
	 */
	public static function totalPurchasesDeclaration() {
		return array(
			'map' => 'function(doc) { if (doc.Type == "purchase") { emit(doc.Customer, doc.Amount); } }',
			'reduce' => 'function(keys, values) { return sum(values) }'
		);
	}

	/**
	 *
	 * @param string $customerNumber
	 * @return integer Total purchases of the customer
	 */
	public function totalPurchasesAmount($customerNumber) {
		return $this->reducedValue('totalPurchases', array(
			'key' => $customerNumber
		));
	}

}
?>