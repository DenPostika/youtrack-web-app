<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class TimeModel extends Model
{
    protected $table = 'tracker';
    protected $fillable = array('id', 'user_id', 'date', 'what_action', 'time');

    public function insertTime( $time )
    {
      return DB::table( $this->table )->insert( $time );
    }

    public function getTimeWhere( $where )
    {
      return DB::table( $this->table )->where( $where )->get();
    }
}
