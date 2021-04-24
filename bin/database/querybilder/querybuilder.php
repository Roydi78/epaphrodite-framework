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

    /**
     * ***************************************************************************************************
     * table
     *
     * @param string $table
     * @return self
    */
    public function table( string $table ):self
    {

        $this->table = "$table";

        return $this;

    }

    /**
     * ***************************************************************************************************
     * insert
     *
     * @param string $insert
     * @return self
    */   
    public function insert( string $insert ):self
    {

        $this->insert = "$insert";

        return $this;
    } 
    
    /**
     * ***************************************************************************************************
     * values
     *
     * @param string $values
     * @return self
    */     
    public function values( string $values ):self
    {

        $this->values = "$values";
        
        return $this;
    }    

    /**
     * ***************************************************************************************************
     * where
     *
     * @param string $where
     * @param string $type
     * @return self
    */     
    public function where(string $where , ?string $type=null ):self
    {
        if( $type==null ){ $this->where = "$where = ?"; }else{ $this->where = "$where $type ?"; }

        return $this;

    }

    /**
     * ***************************************************************************************************
     * like
     *
     * @param string $where
     * @param mixed $sign
     * @return self
    */      
    public function like( string $like , $sign ):self
    {

        $this->like = "$like $sign = ?";

        return $this;

    }    

    /**
     * ***************************************************************************************************
     * limit
     *
     * @param string $begining
     * @param string $end
     * @return self
    */     
    public function limit( string $begining , string $end ):self
    {

        $this->limit = "LIMIT $begining , $end";

        return $this;

    }      

    /**
     * ***************************************************************************************************
     * order by
     *
     * @param string $key
     * @param string $direction
     * @return self
    */ 
    public function orderBy( string $key , string $direction ):self
    {

        $this->order = "ORDER BY $key $direction";

        return $this;

    }  

    /**
     * ***************************************************************************************************
     * group by
     *
     * @param string $group
     * @return self
    */      
    public function groupBy( string $group ):self
    {
        $this->group = "GROUP BY $group";

        return $this;

    }      

    /**
     * ***************************************************************************************************
     * and
     *
     * @param array $getand
     * @return self
    */    
    public function and( $getand=[] ):self{

        foreach($getand as $val)
        {
            $this->and .= " AND " . $val . " = ? ";
        }

        return $this;
    }     

    /**
     * ***************************************************************************************************
     * join
     *
     * @param array $getjoin
     * @return self
    */    
    public function join( $getjoin=[] ):self
    {

        foreach( $getjoin as $val ){

            $this->join .= ' JOIN ' . str_replace( '|' , ' ON ' , $val );

        }

        return $this;
    }    

    
    /**
     * ***************************************************************************************************
     * set
     *
     * @param array $getset
     * @return self
     */    
    public function set( $getset=[] ):self{
        
        foreach($getset as $val){

            $this->set .= $val . " = ?". " , ";;
        }

        $this->set = rtrim($this->set," , ");

        return $this;
    }    

    /**
     * ***************************************************************************************************
     * select query chaine
     *
     * @param array $propriety
     * @return string
     */
    public function SQuery($propriety):string
    {

        if($propriety===NULL){ $propriety='*';}

        /* 
            Select initial query chaine
        */         
        $query = "SELECT $propriety FROM {$this->table}";

        /* 
            Add join if exist
        */         
        if($this->join){

            $query .=" {$this->join}";

        }        

        /* 
            Add where if exist
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
    
    
    /**
     * ***************************************************************************************************
     * insert query chaine
     *
     * @return void
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
   

    /**
     * ***************************************************************************************************
     * Update query chaine
     *  @return string
    */     
    public function UQuery()
    {

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
    
    /**
     * ***************************************************************************************************
     * Delete query chaine
     *
     * @return string
     */     
    public function DQuery()
    {

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
