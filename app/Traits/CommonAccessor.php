<?php
namespace App\Traits;
trait CommonAccessor {
    public function getDateTimeAttribute($value){
        return $value !=null ? date('Y-m-d',strtotime($value)):null;

    }

    public function getTitleAttribute($value){
        return $value !=null ? ucwords($value):null;

    }
    
    public static function getAll($request){
        try {
            $data=self::whereNotNull('id');
            $pdf=$request->pdf ?? 0;
            if ($pdf) {
              return $data=$data->get();
            }
            
            return $data=$data->paginate(1)->appends($_GET);
            
        } catch (\Exception $e) {
            return [];
            dump($e);
            
        }
    }

    public static function getAllWhere($request,$condition=[]){
        try {
            $data=self::whereNotNull('id');
            foreach ($condition as $key => $value) {
              $data=$data->where($key,$value);  # code...
            }
            
            return $data=$data->get();
            return $data=$data->paginate(10)->appends($_GET);
            
        } catch (\Exception $e) {
            return [];
            dump($e);
            
        }
    }

    public static function getAllWhereNOtPaginate($request,$condition=[],$where_not=[]){
        try {
            $data=self::whereNotNull('id');
            foreach ($condition as $key => $value) {
              $data=$data->where($key,$value);  # code...
            }
            foreach ($where_not as $key => $value) {
              $data=$data->where($key,'!=',$value);  # code...
            }
            return $data=$data->get();
            
            
            
            
        } catch (\Exception $e) {
            return [];
            dump($e);
            
        }
    }
    public static function getAllNotMe($request,$id){
        try {
            $data=self::where('id','!=',$id);
            $pdf=$request->pdf ?? 0;
            if ($pdf) {
              return $data=$data->get();
            }
            
            return $data=$data->paginate(10)->appends($_GET);
            
        } catch (\Exception $e) {
            return [];
            dump($e);
            
        }
    }
    
    public static function getAllNotPaginate($request=[]){
        try {
            return $data=self::get();
            
        } catch (\Exception $e) {
            return [];
            dump($e);
            
        }
    }

    public static function findById($id){
        try {
            return $data=self::find($id);
            
        } catch (\Exception $e) {
            return false;
            dump($e);
            
        }
    }
  

   

    public static function updateData($request,$id){
        try {
            $data=self::where('id',$id)->update($request);
            if($data){
                return ['status'=>200,'message'=>'Data successfully updated','data'=>$data];
            }
            return ['status'=>400,'message'=>'Something Went to wrong','data'=>''];
            
        } catch (\Exception $e) {
            dump($e);
            return ['status'=>400,'message'=>'Something Went to wrong','data'=>''];
        }

    }

     public static function storeData($request){
        try {
            $data=self::create($request);
            if($data){
                return ['status'=>200,'message'=>'data successfully completed','data'=>$data];
            }
            return ['status'=>400,'message'=>'Something Went to wrong','data'=>''];
            
        } catch (\Exception $e) {
            dump($e);
            return ['status'=>400,'message'=>'Something Went to wrong','data'=>''];
        }
        
    }

     public static function deleteById($id){
        try {
            $data=self::where('id',$id)->delete();
            if($data){
                return ['status'=>200,'message'=>'Action Successful','data'=>$data];
            }
            return ['status'=>400,'message'=>'Something Went to wrong','data'=>''];
            
        } catch (\Exception $e) {
            dump($e);
            return ['status'=>400,'message'=>'Something Went to wrong','data'=>''];
        }
        
    }

    public static function updateOrCreateData($condition=[],$request){
        try {
            $data=self::updateOrCreate($condition,$request);
            if($data){
                return ['status'=>200,'message'=>'data successfully completed','data'=>$data];
            }
            return ['status'=>400,'message'=>'Something Went to wrong','data'=>''];
            
        } catch (\Exception $e) {
            dump($e);
            return ['status'=>400,'message'=>'Something Went to wrong','data'=>''];
        }
        
    }

    public static function insertData($request){
        try {
            $data=self::insert($request);
            if($data){
                return ['status'=>200,'message'=>'data successfully completed','data'=>$data];
            }
            return ['status'=>400,'message'=>'Something Went to wrong','data'=>''];
            
        } catch (\Exception $e) {
            dump($e);
            return ['status'=>400,'message'=>'Something Went to wrong','data'=>''];
        }
        
    }

    
 

    public static function getColumns(){
        $self_class='\\'.get_called_class();
        $myclass=new $self_class();
        return $myclass->getConnection()->getSchemaBuilder()->getColumnListing($myclass->getTable());
        //return $this->Columns();

    }

    public static function getModelTables(){
        $self_class='\\'.get_called_class();
        $myclass=new $self_class();
        return $myclass->getTable();
        //return $this->Columns();

    }


    

    


  
}