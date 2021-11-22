<?php
/**
 *
 */
class Application
{
	private $familyName;
	private $name;
	private $surname;
	private $gender;
	private $civilStatus;
	private $profession;
	private $birthday;
	private $birthCertificateNo;
	private $placeOfBirth;
	private $birthDivision;
	private $birthDistrict;
	private $countryOfBirth;
	private $birthCity;
	private $citizenshipCertificateNo;
	private $permHouseName;
	private $permRoad;
	private $permVillage;
	private $permPostalCode;
	private $postalHouseName;
	private $postalRoad;
	private $postalVillage;
	private $postalPostalCode;
	private $citizenshipCertificateType;
	// private $citizenshipCertificateNo;
	private $citizenshipCertificateDate;
	private $residenceTelNo;
	private $mobileTelNo;
	private $email;
	private $purpose;
	private $lostIdNum;
	private $lostIdDate;
	private $policeStationName;
	private $policeReportDate;
	private $photographs;
	private $receiptNo;
	private $receipt;
	private $para_1;
	private $para_2;
	private $certifyName;

	private $approvableArray;
	// private $
	// private $
	// private $
	public function __construct($attributeArray,$applicant_id)
	{
		
		$this->familyName = $attributeArray['familyName'];
		$this->name = $attributeArray['name'];
		$this->surname = $attributeArray['surname'];
		$this->gender = $attributeArray['gender'];
		$this->civilStatus = $attributeArray['civilStatus'];
		$this->profession = $attributeArray['profession'];
		$this->birthday = $attributeArray['birthday'];
		$this->birthCertificateNo = $attributeArray['birthCertificateNo'];
		$this->placeOfBirth = $attributeArray['placeOfBirth'];
		$this->birthDivision = $attributeArray['birthDivision'];
		$this->birthDistrict = $attributeArray['birthDistrict'];
		$this->countryOfBirth = $attributeArray['countryOfBirth'];
		$this->birthCity = $attributeArray['birthCity'];
		$this->citizenshipCertificateNo = $attributeArray['citizenshipCertificateNo'];
		$this->permHouseName = $attributeArray['permHouseName'];
		$this->permRoad = $attributeArray['permRoad'];
		$this->permVillage = $attributeArray['permVillage'];
		$this->permPostalCode = $attributeArray['permPostalCode'];
		$this->postalHouseName = $attributeArray['postalHouseName'];
		$this->postalRoad = $attributeArray['postalRoad'];
		$this->postalVillage = $attributeArray['postalVillage'];
		$this->postalPostalCode = $attributeArray['postalPostalCode'];
		$this->citizenshipCertificateType = $attributeArray['citizenshipCertificateType'];
		//  $this->citizenshipCertificateNo = $attributeArray[''];
		$this->citizenshipCertificateDate = $attributeArray['citizenshipCertificateDate'];
		$this->residenceTelNo = $attributeArray['residenceTelNo'];
		$this->mobileTelNo = $attributeArray['mobileTelNo'];
		$this->email = $attributeArray['email'];
		$this->purpose = $attributeArray['purpose'];
		$this->lostIdNum = $attributeArray['lostIdNum'];
		$this->lostIdDate = $attributeArray['lostIdDate'];
		$this->policeStationName = $attributeArray['policeStationName'];
		$this->policeReportDate = $attributeArray['policeReportDate'];
		$this->photographs = $attributeArray['photographs'];
		$this->receiptNo = $attributeArray['receiptNo'];
		$this->receipt = $attributeArray['receipt'];
		$this->para_1 = $attributeArray['para_1'];
		$this->para_2 = $attributeArray['para_2'];
		$this->certifyName = $attributeArray['certifyName'];
		$approvableArray = array();
		$this->fillApprovableArray($applicant_id);
	}

	
	public function fillApprovableArray($user_id)
	{
		array_push($approvableArray,$user_id);
	}
}

?>
