<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use App\StudentData as StudentData;

class User extends Authenticatable
{
    //
    use HasRoles;
    protected $fillable = ['name', 'email', 'phone', 'password'];

    public function allowedClasses(){

        //debug hasOne method
            //$accessible_entities = $this->hasOne('App\Models\AccessibleEntities','user_id','id');
            $accessible_entities = AccessibleEntities::where('user_id',$this->id)->first();
            //dubug 
            //die($accessible_entities);
            if($this->hasPermissionTo('access_all_entities')){
                return StudentData::all();
            }
            elseif($accessible_entities!=null | $accessible_entities!=""){
    
                return StudentData::find( json_decode($accessible_entities->school_classes) );
    
            }
            else{
                return null;
            }
    }

    // public function allowedSubjects(){

    //     //debug hasOne method
    //         //$accessible_entities = $this->hasOne('App\Models\AccessibleEntities','user_id','id');
    //         $accessible_entities = AccessibleEntities::where('user_id',$this->id)->first();
    //         //dubug 
    //         //die($accessible_entities);
    //         if($this->hasPermissionTo('access_all_entities')){
    //             return StudentData::all();
    //         }
    //         elseif($accessible_entities!=null | $accessible_entities!=""){
    
    //             return StudentData::find( json_decode($accessible_entities->school_classes) );
    
    //         }
    //         else{
    //             return null;
    //         }
    // }

    public function canAccessClass($class_id){
        //debug hasOne method
        //$accessible_entities = $this->hasOne('App\Models\AccessibleEntities','user_id','id');
        $accessible_entities = AccessibleEntities::where('user_id',$this->id)->first();
        //dubug 
        //die($accessible_entities);
        if($this->hasPermissionTo('access_all_entities')){
            return true;
        }
        elseif($accessible_entities!=null){

            if (in_array($class_id,json_decode($accessible_entities->school_classes))) {
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }    
        
    }

    public function canAccessStudent($subject_id){
        //debug hasOne method
        //$accessible_entities = $this->hasOne('App\Models\AccessibleEntities','user_id','id');
        $accessible_entities = AccessibleEntities::where('user_id',$this->id)->first();
        //dubug 
        //die($accessible_entities);
        if($this->hasPermissionTo('access_all_entities')){
            return true;
        }
        elseif($accessible_entities!=null){

            if (in_array($subject_id,json_decode($accessible_entities->school_subject))) {
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }    
        
    }


    public function accessibleEntities(){
        return AccessibleEntities::where('user_id',$this->id)->first();
        
    }
}
