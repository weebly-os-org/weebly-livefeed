<?php 

namespace App\Model;
 
use Illuminate\Database\Eloquent\Model;


class User extends Model
{
	protected $table = 'users';
	public $timestamps = false;
	protected $primaryKey = 'user_id';
	protected $fillable = ['username', 'password_hash', 'reset_token'];

	/**
	 * Authenticate a User
	 *
	 * @param string $password
	 * @return bool
	 */
	public function authenticate($password)
	{
		return password_verify($password, $this->password_hash);
	}

	/**
	 * Emails user to reset their livefeed password
	 *
	 * @return void
	 */
	public function sendResetEmail()
	{
		$email = $this->username;
		\Illuminate\Support\Facades\Mail::send('emails.reset_password', ['token' => $this->reset_token], function($message) use($email) {
		    $message->to($email)
		    	->subject('Set your password!')
		    	->from('noreply@bashley.net');
		});
	}
}