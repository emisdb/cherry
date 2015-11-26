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
    public $new_password;
    public $new_confirm;

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
            array('id, id_usergroups, role_ob, username, profile, lastlogin, id_city, id_guide, guide_ob, id_contact, contact_ob,tourcategories_sv', 'safe', 'on'=>'search'),
           // array('id, id_usergroups, role_ob, username, profile, lastlogin, id_city, id_guide, guide_ob, id_contact, contact_ob,tourcategories_sv', 'safe', 'on'=>'search_admin'),
          
            //array('id,username, profile', 'safe', 'on'=>'search_root'),
		
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
           
            //'id_city'=>array(self::BELONGS_TO, 'SegGuidesdata', 'id_guide'),
           // ''
             
            //  'tourcategories_sv'=>array(self::HAS_ONE, 'SegGuidesTourroutes', 'usersid'),
              
        
			//'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
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
			'new_password' => 'Password',
			'profile' => 'Info',
            'new_confirm' => 'Password repeat',
            'id_usergroups' => 'ID Role',
            'status' => 'Status',
            'role_ob' => 'Role',
            'lastlogin' => 'Last login',
            'id_city' => 'ID City',
            'id_contact' => 'ID Contact',
            'contact_ob' =>'Contact info',
            'id_guide' => 'ID Guide',
		);
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

        $criteria->with = array('role_ob','contact_ob','guide_ob');
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

        $criteria->condition='id_usergroups<>:id_usergroups1 AND id_usergroups<>:id_usergroups2 AND id_usergroups<>:id_usergroups3';
        $criteria->params=array(':id_usergroups1'=>1,':id_usergroups2'=>2,':id_usergroups3'=>3);

        $criteria->with = array('role_ob','contact_ob','guide_ob');
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

 /*   public function search111()
	{
		$criteria=new CDbCriteria;
		
        
//        $criteria->condition = 'id_languages=:id_languages';
  //          $criteria->params = array(':id_languages' => $lancat_item->languages_id);
         //   $lan_ob = Languages::model()->find($criteria_lani);
            
        
        
        $criteria->compare('id',$this->id);
		//$criteria->compare('username',$this->username,true);
		$criteria->compare('profile',$this->profile,true);

        $criteria->with = array('role_ob','contact_ob','guide_ob');
		$criteria->compare('role_ob.idusergroups',$this->role_ob);
		$criteria->compare('contact_ob.idcontacts',$this->contact_ob);
        $criteria->compare('guide_ob.idseg_guidesdata',$this->guide_ob);
       //$criteria->compare('tourcategories_sv.idseg_guides_tourrouters',$this->tourcategories_sv);
   //     $criteria->condition="username<>'root'";
       // $criteria->params=array(':username'=>1);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}*/

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
