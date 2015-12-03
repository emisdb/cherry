<?php

/**
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $profile
 */
class User extends CActiveRecord
{
	const TYPE_INACTIVE=0;
	const TYPE_ACTIVE=1;
	public $new_password;
    public $new_confirm;
	private $_use = null;
	private $_name = null;
	public function getGuidename(){
		if ($this->_name === null && $this->contact_ob !== null)
		{
			if(count($this->contact_ob)>0)
			$this->_name = $this->contact_ob->firstname.' '.$this->contact_ob->surname;
		}
		return $this->_name;
	}
	public function setGuidename($value){
		$this->_name = $value;
	}
	public function getCityname(){
		if ($this->_use === null && $this->city !== null)
		{
			if(count($this->city)>0)
			$this->_use = $this->city->cities->seg_cityname;
		}
		return $this->_use;
	}
	public function setCityname($value){
		$this->_use = $value;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return static the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username', 'required'),
			array('username, new_password, new_confirm', 'length', 'max'=>128),
            array('lastlogin, id_city, id_guide, id_contact', 'numerical', 'integerOnly'=>true),
            array('username', 'unique'),
            array('new_password', 'length', 'min'=>6, 'allowEmpty'=>true),
            array('new_confirm', 'compare', 'compareAttribute'=>'new_password', 'message'=>'Passwords do not match'), 
			array('profile', 'safe'),
//            array('id, id_usergroups, role_ob, username, profile, lastlogin, id_city, id_guide, guide_ob, id_contact, contact_ob,tourcategories_sv', 'safe', 'on'=>'search'),
            array('id, id_usergroups, role_ob, username,status, profile, lastlogin, id_city, id_guide, guide_ob, id_contact, contact_ob,tourcategories_sv,cityname,guidename', 'safe', 'on'=>'search_office'),
           // array('id, id_usergroups, role_ob, username, profile, lastlogin, id_city, id_guide, guide_ob, id_contact, contact_ob,tourcategories_sv', 'safe', 'on'=>'search_admin'),
          
//            array('id,username, profile', 'safe', 'on'=>'search_office'),
		
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'role_ob'=>array(self::BELONGS_TO, 'Usergroups', 'id_usergroups'),
            'contact_ob'=>array(self::BELONGS_TO, 'SegContacts', 'id_contact'),
            'guide_ob'=>array(self::BELONGS_TO, 'SegGuidesdata', 'id_guide'),
            'languages' => array(self::MANY_MANY, 'Languages', 'seg_languages_guides(users_id, languages_id)'),
			 'guidestourroutes'=>array(self::MANY_MANY, 'TourCategories', 'seg_guides_tourroutes(usersid,tourroutes_id)'),
     		'cities' => array(self::HAS_MANY, 'SegGuidesCities', 'users_id'),
     		'city' => array(self::HAS_ONE, 'SegGuidesCities', 'users_id'),
//            'city' => array(self::MANY_MANY, 'SegCities', 'seg_guides_cities(users_id, cities_id)'),
            'paySum'=>array(self::STAT, 'CashboxChangeRequests', 'id_users', 'select'=> 'SUM(delta_cash)','condition'=>'approvedBy IS NOT NULL'),
       
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'username' => 'Username',
			'guidename' => 'Guide\'s name',
			'new_password' => 'Password',
			'profile' => 'Info',
            'new_confirm' => 'Password repeat',
            'id_usergroups' => 'ID Role',
            'status' => 'Active',
            'role_ob' => 'Role',
            'lastlogin' => 'Last login',
            'id_city' => 'ID City',
            'cityname' => 'City',
            'id_contact' => 'ID Contact',
            'contact_ob' =>'Contact info',
            'id_guide' => 'ID Guide',
           'paySum' => 'Balance',
		);
	}
	public function getStatusOptions()
	{
	return array(
		self::TYPE_ACTIVE=>'Y',
		self::TYPE_INACTIVE=>'N',
		);
	}
	public function getStatusText()
	{
			$statusOptions=$this->statusOptions;
			return isset($statusOptions[$this->status]) ?	$statusOptions[$this->status] : "unknown status ({$this->status_id})";
	}
 public function statuslabel($data, $row)
{
	 			$statusOptions=$this->statusOptions;
			return isset($statusOptions[$data->status]) ?	$statusOptions[$data->status] : "unknown status ({$data->status})";


 }
	   /*  public function search()
	{
		$criteria=new CDbCriteria;
    	$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('profile',$this->profile,true);
        
       
      
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}*/


    public function search_root()
	{
		$criteria=new CDbCriteria;

        $criteria->condition='id_usergroups<>:id_usergroups1';
        $criteria->params=array(':id_usergroups1'=>1);


        $criteria->with = array('role_ob','contact_ob','guide_ob');
		$criteria->compare('role_ob.idusergroups',$this->role_ob,true);
		$criteria->compare('contact_ob.idcontacts',$this->contact_ob);
        $criteria->compare('guide_ob.idseg_guidesdata',$this->guide_ob);
        
       	$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('profile',$this->profile,true);
      
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function search_admin()
	{
		$criteria=new CDbCriteria;
    	
        $criteria->condition='id_usergroups<>:id_usergroups1 AND id_usergroups<>:id_usergroups2';
        $criteria->params=array(':id_usergroups1'=>1,':id_usergroups2'=>2);

        $criteria->with = array('role_ob','contact_ob','guide_ob',array('city'=>'cities'),'paySum');
		$criteria->compare('role_ob.idusergroups',$this->role_ob);
		$criteria->compare('contact_ob.idcontacts',$this->contact_ob);
        $criteria->compare('guide_ob.idseg_guidesdata',$this->guide_ob);
        
        $criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('profile',$this->profile,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function search_office()
	{
		$criteria=new CDbCriteria;
		$sort   = new CSort;

        $criteria->condition='id_usergroups<>:id_usergroups1 AND id_usergroups<>:id_usergroups2 AND id_usergroups<>:id_usergroups3';
        $criteria->params=array(':id_usergroups1'=>1,':id_usergroups2'=>2,':id_usergroups3'=>3);

        $criteria->with = array('role_ob','contact_ob','guide_ob','city'=>array('with'=>'cities'));
		$criteria->compare('cities.seg_cityname',$this->cityname,true);
		$criteria->compare('role_ob.idusergroups',$this->role_ob);
		$criteria->compare('contact_ob.idcontacts',$this->contact_ob);
//  		$criteria->compare('contact_ob.firstname',$this->guidename,true,'OR');
//   		$criteria->compare('contact_ob.surname',$this->guidename,true,'OR');
		if(strlen($this->guidename)>0)
		   $criteria->addCondition('contact_ob.firstname LIKE \'%'.$this->guidename.'%\' OR contact_ob.surname LIKE \'%'.$this->guidename.'%\'');
       $criteria->compare('guide_ob.idseg_guidesdata',$this->guide_ob);
        
       	$criteria->compare('id',$this->id);
       	$criteria->compare('status',$this->status);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('profile',$this->profile,true);
		$sort->attributes = array(
			'*',
			'cityname'=>array('asc'=>'cities.seg_cityname',
							'desc'=>'cities.seg_cityname DESC', 
							'label'=>'City'),
			'guidename'=>array('asc'=>'contact_ob.firstname, contact_ob.surname',
							'desc'=>'contact_ob.firstname DESC, contact_ob.surname DESC', 
							'label'=>'Guide\'s name'),
		);

		return new CActiveDataProvider($this, array(
	             'pagination'=>array('pageSize'=>50),
                 'criteria'=>$criteria,
                    'sort'=>$sort,
		));
	}


    protected function beforeSave()
    {
        if ($this->new_password)
        {
            $this->salt = self::generateSalt();
            $this->password = $this->hashPassword($this->new_password, $this->salt);
        }
        return parent::beforeSave();
    }

	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		//return crypt($password,$this->password)===$this->password;
		return $this->hashPassword($password,$this->salt)===$this->password;
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
		
	public function hashPassword($password,$salt)
	{
		return md5($salt.$password);
	}
		
	/*public function hashPassword($password)
	{
		return crypt($password, $this->generateSalt());
	}*/

	/**
	 * Generates a salt that can be used to generate a password hash.
	 *
	 * The {@link http://php.net/manual/en/function.crypt.php PHP `crypt()` built-in function}
	 * requires, for the Blowfish hash algorithm, a salt string in a specific format:
	 *  - "$2a$"
	 *  - a two digit cost parameter
	 *  - "$"
	 *  - 22 characters from the alphabet "./0-9A-Za-z".
	 *
	 * @param int cost parameter for Blowfish hash algorithm
	 * @return string the salt
	 */

     public function randomSalt($length=32)
     {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double)microtime()*1000000);
        $i = 1;
        $salt = '' ;

        while ($i <= $length)
        {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $salt .= $tmp;
            $i++;
        }
        return $salt;
    } 
	
	protected function generateSalt($cost=10)
	{
		if(!is_numeric($cost)||$cost<4||$cost>31){
			throw new CException(Yii::t('Cost parameter must be between 4 and 31.'));
		}
		// Get some pseudo-random data from mt_rand().
		$rand='';
		for($i=0;$i<8;++$i)
			$rand.=pack('S',mt_rand(0,0xffff));
		// Add the microtime for a little more entropy.
		$rand.=microtime();
		// Mix the bits cryptographically.
		$rand=sha1($rand,true);
		// Form the prefix that specifies hash algorithm type and cost parameter.
		$salt='$2a$'.str_pad((int)$cost,2,'0',STR_PAD_RIGHT).'$';
		// Append the random salt string in the required base64 format.
		$salt.=strtr(substr(base64_encode($rand),0,22),array('+'=>'.'));
		return $salt;
	}
}
