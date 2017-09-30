<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubscritpionMaster;
use Carbon;

class SubscriptionTransaction extends Model {

	protected $guarded =[];
	public $timestamps = false;

		protected $primaryKey = "id";
		protected $table = "subscription_transaction";



	public static function SubcriptionPackage($data)
       {
       
       if($data['user_type'] == 2)
       {
			$category = 2;
       }
       else
       {
       		$category = 1;
       }
       
       
      $package_records = SubscritpionMaster::where('type', $data['sub_type'])->where('category', $category)->get();

       if($data['user_type'] == 2)
       {

       	$reference_id = \DB::select('SELECT MAX(s.id) as refer_id FROM `subscription_transaction` as s WHERE s.college_id = :d AND s.id=(SELECT MAX(str.id) FROM `subscription_transaction` AS str WHERE str.college_id = :e)',array('d' => $data['user_id'] , 'e' => $data['user_id']));

       	$prev_amount = \DB::select('SELECT s.amount_balance AS previous_amount FROM `subscription_transaction` as s
               WHERE s.college_id = :d AND CASE WHEN s.ref_id != 0 THEN id=(SELECT MAX(stto.ref_id) FROM subscription_transaction AS stto WHERE  stto.college_id = :e)  ELSE s.ref_id = 0 END ORDER BY s.id DESC LIMIT 1',array('d' => $data['user_id'] , 'e' => $data['user_id']));
       }
       else
       {

       	$reference_id = \DB::select('SELECT MAX(s.id) as refer_id FROM `subscription_transaction` as s WHERE s.company_id = :d AND s.id=(SELECT MAX(str.id) FROM `subscription_transaction` AS str WHERE str.company_id = :e)',array('d' => $data['user_id'] , 'e' => $data['user_id']));

       	$prev_amount = \DB::select('SELECT s.amount_balance AS previous_amount FROM `subscription_transaction` as s
               WHERE s.company_id = :d AND CASE WHEN s.ref_id != 0 THEN id=(SELECT MAX(stto.ref_id) FROM subscription_transaction AS stto WHERE  stto.company_id = :e)  ELSE s.ref_id = 0 END ORDER BY s.id DESC LIMIT 1',array('d' => $data['user_id'] , 'e' => $data['user_id']));
       }
        
		if(!empty($prev_amount))
		{
			$prev_amt = $prev_amount[0]->previous_amount;
		}
		else
		{
			$prev_amt = 0;
		}

		if($reference_id[0]->refer_id != null)
		{
			$subscription_data['ref_id'] = $reference_id[0]->refer_id;
		}
		else
		{
			$subscription_data['ref_id'] = 0;
		}
       	
       	$subscription_data['use_of_pack'] = $data['use_of_pack'];
       	$subscription_data['date_of_purchase'] = Carbon::now()->toDateTimeString();
       	if($data['user_type'] == 2)
       {
       	 $subscription_data['college_id'] = $data['user_id'];
       }
       	else
       	{
       		$subscription_data['company_id'] = $data['user_id'];
       	}
       	$subscription_data['subscription_type'] = $data['sub_type'];
        $subscription_data['sms_count'] = $package_records[0]->sms_count;
       	$subscription_data['email_count'] = $package_records[0]->email_count;
       	$subscription_data['access_candidate_profile'] = $package_records[0]->access_candidate_profile;
       	$subscription_data['assessed_candidate_profile'] = $package_records[0]->assessed_candidate_profile;
       	$subscription_data['online_assessment_test'] = $package_records[0]->online_assessment_test;
       	$subscription_data['technical_domain_test'] = $package_records[0]->technical_domain_test;
       	$subscription_data['sms_free'] = $package_records[0]->sms_free;
       	$subscription_data['email_free'] = $package_records[0]->email_free;
       	$subscription_data['subscription_amount'] = $package_records[0]->total_amount;
       	$subscription_data['paid_amount'] = $data['paid_amount'];
       	$subscription_data['total_amount'] = $package_records[0]->total_amount + $prev_amt;
       	$subscription_data['amount_balance'] = $subscription_data['total_amount'] - $data['paid_amount'];
       	$subscription_data['created_on'] = Carbon::now()->toDateTimeString();
        $subscription_data['created_by'] = $data['user_id'];
       	
       	$subscription_signup = SubscriptionTransaction::create($subscription_data);

        return 'Success';

      }









}
