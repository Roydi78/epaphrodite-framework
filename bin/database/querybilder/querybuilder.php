<?php

namespace bin\database\querybilder;

class querybuilder{

    private $table;
    private $where;
    private $like;
    private $and;
    private $order;
    private $join;
    private $limit;
    private $group;
    private $insert;
    private $values;   
    private $set;       

    /* 
        Database table 
    */
    public function table(string $table ):self{
        $this->table = "$table";
        return $this;
    }

     /* 
        Insert datas 
    */     
    public function insert(string $insert ):self{

        $this->insert = "$insert";

        return $this;
    } 
    
    /* 
        Insert Values 
    */     
    public function values(string $values ):self{

        $this->values = "$values";
        
        return $this;
    }    

    /* 
        Where 
    */    
    public function where(string $where ):self{

        $this->where = "$where = ?";

        return $this;

    }

    /* 
        Like 
    */    
    public function like(string $like , $sign ):self{

        $this->like = "$like $sign = ?";

        return $this;

    }    

    /* 
        limit 
    */     
    public function limit(string $begining , string $end ):self{

        $this->limit = "LIMIT $begining , $end";

        return $this;

    }      

    /* 
        order by 
    */     
    public function orderBy(string $key , string $direction ):self{
        $this->order = "ORDER BY $key $direction";
        return $this;
    }  

    /* 
        group by 
    */     
    public function groupBy(string $group ):self{
        $this->group = "GROUP BY $group";
        return $this;
    }      

    /* 
        and 
    */     
    public function and( $getand=[] ):self{

        foreach($getand as $val){
            $this->and .= " AND " . $val . " = ? ";
        }

        return $this;
    }     

    /* 
        join table
    */     
    public function join( $getjoin=[] ):self{

        if(count($getjoin)==1){ $datas=explode('|',$getjoin[0]); $this->join = "$datas[0] ON $datas[1]"; }
        if(count($getjoin)==2){ $datas=explode('|',$getjoin[0]); $datas1=explode('|',$getjoin[1]); $this->join = "$datas[0] ON $datas[1] JOIN $datas1[0] ON $datas1[1]"; }
        if(count($getjoin)==3){ $datas=explode('|',$getjoin[0]); $datas1=explode('|',$getjoin[1]); $datas2=explode('|',$getjoin[2]); $this->join = "$datas[0] ON $datas[1] JOIN $datas1[0] ON $datas1[1] JOIN $datas2[0] ON $datas2[1]"; }
        if(count($getjoin)==4){ $datas=explode('|',$getjoin[0]); $datas1=explode('|',$getjoin[1]); $datas2=explode('|',$getjoin[2]); $datas3=explode('|',$getjoin[3]); $this->join = "$datas[0] ON $datas[1] JOIN $datas1[0] ON $datas1[1] JOIN $datas2[0] ON $datas2[1] JOIN $datas3[0] ON $datas3[1]"; }
        if(count($getjoin)==5){ $datas=explode('|',$getjoin[0]); $datas1=explode('|',$getjoin[1]); $datas2=explode('|',$getjoin[2]); $datas3=explode('|',$getjoin[3]); $datas4=explode('|',$getjoin[4]); $this->join = "$datas[0] ON $datas[1] JOIN $datas1[0] ON $datas1[1] JOIN $datas2[0] ON $datas2[1] JOIN $datas3[0] ON $datas3[1]  JOIN $datas4[0] ON $datas4[1]"; }

        return $this;
    }    

    
    /* 
        and 
    */     
    public function set( $getset=[] ):self{
        
        foreach($getset as $val){
            $this->set .= $val . " = ?". " , ";;
        }

        $this->set = rtrim($this->set," , ");

        return $this;
    }    

    /* 
        Select Query chaine builder
    */ 
    public function SQuery($propriety):string{

        if($propriety===NULL){ $propriety='*';}

        /* 
            Select initial query chaine
        */         
        $query = "SELECT $propriety FROM {$this->table}";

        /* 
            Add JOIN if exist
        */         
        if($this->join){
            $query .=" JOIN {$this->join}";
        }        

        /* 
            Add WHERE if exist
        */         
        if($this->where){
            $query .=" WHERE {$this->where}";
        }

        /* 
            Add LIKE if exist
        */         
        if($this->like){
            $query .=" LIKE {$this->like} ";
        }          

        /* 
            Add AND if exist
        */         
        if($this->and){
            $query .="{$this->and}";
        } 
        
        /* 
            Add ORDER BY if exist
        */         
        if($this->order){
            $query .=" {$this->order}";
        }   

        /* 
            Add GROUP BY if exist
        */         
        if($this->group){
            $query .=" {$this->group}";
        }          
        
        /* 
            Add LIMIT if exist
        */         
        if($this->limit){
            $query .=" {$this->limit}";
        }          

        return $query;
    }   
    
    
    /* 
        Insert Query chaine builder
    */     
    public function IQuery(){

        /* 
            Insert initial query chaine
        */ 
        $Iquery = "INSERT INTO {$this->table} ";

        /* 
            Add DATAS if exist
        */         
        if($this->insert){
            $Iquery .="( {$this->insert} )";
        }  
        
        /* 
            Add VALUES if exist
        */         
        if($this->values){
            $Iquery .=" VALUES ( {$this->values} )";
        }           

        return $Iquery;

    }   
   

    /* 
        Update Query chaine builder
    */     
    public function UQuery(){

        /* 
            Update inital query chaine
        */ 
        $query = "UPDATE {$this->table} SET ";
        
        /* 
            Add SET if exist
        */  
        if($this->set){
            $query .=" {$this->set}";
        }  

        /* 
            Add WHERE if exist
        */         
        if($this->where){
            $query .=" WHERE {$this->where} ";
        } 
        
        /* 
            Add LIKE if exist
        */         
        if($this->like){
            $query .=" LIKE {$this->like} ";
        }          
        
        /* 
            Add AND if exist
        */          
        if($this->and){
            $query .=" AND {$this->and}";
        }           

        return $query;

    }
    
    /* 
        Delete Query chaine builder
    */     
    public function DQuery(){

        /* 
            Update inital query chaine
        */ 
        $query = "DELETE FROM {$this->table} ";

        /* 
            Add WHERE if exist
        */         
        if($this->where){
            $query .=" WHERE {$this->where} ";
        }  
        
        /* 
            Add LIKE if exist
        */         
        if($this->like){
            $query .=" LIKE {$this->like} ";
        }          
        
        /* 
            Add AND if exist
        */          
        if($this->and){
            $query .=" AND {$this->and}";
        }           

        return $query;

    }      

}
