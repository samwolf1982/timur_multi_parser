<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Ownsave;


use common\models\Maxdate;
/**
 * OwnsaveSearch represents the model behind the search form about `common\models\Ownsave`.
 */
class OwnsaveSearch extends Ownsave
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'site_id', 'price', 'price_m', 'count_rooms', 'square', 'floor', 'floors'], 'integer'],
            [['shortdistrict', 'phone', 'currency', 'type', 'district', 'street', 'street2', 'description', 'state', 'material', 'own_or_business', 'manager', 'coment', 'url', 'site', 'img', 'date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     *  is_own < 0 -->my save,   0--> all save,   ==1 --> own add  2--> ouradd 
     * @param array $params
     *
     * @param  int is_own  
     * @return ActiveDataProvider
     */
    public function search($params,$is_own=0)
    {
        
          
        if ($is_own < 0) {
          $query = Ownsave::find()->joinWith('userSaves')->where(['u_id' => Yii::$app->user->identity->id]);
        }elseif($is_own==0){
        $query = Ownsave::find()->innerJoinWith('userSaves','userSaves.o_id=id')->where(1);
        }elseif ($is_own==1) {
          // $query = Ownsave::find()->innerJoinWith('userSaves','userSaves.o_id=id')->where(['userSaves.some'=>1]);
          $query = Ownsave::find()->joinWith('userSaves')->where(['u_id' => Yii::$app->user->identity->id,'some'=>1]);
        }
        elseif ($is_own==2) {
          // $query = Ownsave::find()->innerJoinWith('userSaves','userSaves.o_id=id')->where(['userSaves.some'=>1]);
          $query = Ownsave::find()->joinWith('userSaves')->where(['some'=>1]);
        }
    //      Customer::find()
    // ->joinWith('orders')
    // ->where(['order.status' => Order::STATUS_ACTIVE])
    // ->all();
// SELECT * 
//FROM  `rooms` 
//INNER JOIN  `user_save` ON rooms.id = user_save.o_id
//WHERE user_save.u_id =  "13"
//LIMIT 0 , 30
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

           
        // get curent day
        $max_date  = Maxdate::find()->andWhere(['site'=>'OLX'])->max('dt');

       $datez = new \DateTime( $max_date);
     $new_date_format  = $datez->format('Y-m-d H:i:s');
         
     $max_id  = Maxdate::find()->select('max_id')->where(['dt'=>$max_date])->one();


    // \Yii::trace(["own: "=> $new_date_format, ] );
 



   //$query->andFilterWhere(['>', 'site_id', $max_id->max_id]);
  //$query->andFilterWhere(['>', 'site_id', $max_id->max_id]);
  //$query->orFilterWhere(['>=', 'date', $new_date_format]);
 
  //2017-01-05 



                      if(preg_match("/^[0-9]+-[0-9]+/", $this->price)){
                        list($min_p, $max_p) = explode("-", $this->price, 2);
                         $query->andFilterWhere(['between', 'price', $min_p,$max_p]);
                        
                      }else{
                           $query->andFilterWhere([ 'price' => $this->price,]);
                      }
                      
                      if(preg_match("/^[0-9]+-[0-9]+/", $this->price_m)){
                        list($min_p2, $max_p2) = explode("-", $this->price_m, 2);
                         $query->andFilterWhere(['between', 'price_m', $min_p2,$max_p2]);
                        
                      }else{
                           $query->andFilterWhere([ 'price_m' => $this->price_m,]);
                      }
                      
                      
                        if(preg_match("/^[0-9]+-[0-9]+/", $this->square)){
                        list($min_p2, $max_p2) = explode("-", $this->square, 2);
                         $query->andFilterWhere(['between', 'square', $min_p2,$max_p2]);
                        
                      }else{
                           $query->andFilterWhere([ 'square' => $this->square,]);
                      }
                      
                      
                      // <> site id
                      
                      if(preg_match('/(<=|>=|<|>)/', $this->site_id, $operator) ){
                          preg_match('/\d+/', $this->site_id, $views);
                          
                           $operator = isset($operator[0]) ? $operator[0] : '=';
                           $views = isset($views[0]) ? $views[0] : '0';
                            $query->andFilterWhere([$operator,'site_id', $views]);
                      }
           
           
           
                        if(preg_match('/\|/', $this->description) ){
                     
                             $art=  explode('|',$this->description) ;
                             
                             foreach($art as $v ){
          $query ->orFilterWhere(['like', 'description', $v])   ;   
                                
                             }
                            }else{
          $query->andFilterWhere(['like', 'description', $this->description]);    
                            }   
                            
                            /////////////// 
                                  if(preg_match('/\|/', $this->shortdistrict) ){
                     
                             $art=  explode('|',$this->shortdistrict) ;
                             
                             foreach($art as $v ){
          $query ->orFilterWhere(['like', 'shortdistrict', $v])   ;   
                                
                             }
                            }else{
          $query->andFilterWhere(['like', 'shortdistrict', $this->shortdistrict]);    
                            }    
                            
                  ////////////
                  
                          ///////////////  ---------------  street2
                                  if(preg_match('/\|/', $this->street2) ){
                     
                             $art=  explode('|',$this->street2) ;
                             
                             foreach($art as $v ){
          $query ->orFilterWhere(['like', 'street2', $v])   ;   
                                
                             }
                            }else{
          $query->andFilterWhere(['like', 'street2', $this->street2]);    
                            }    
                                     
           
           

        
        
        
       
        
         
        
        $query->andFilterWhere([
            'id' => $this->id,
           // 'price' => $this->price,
           // 'price_m' => $this->price_m,
           'count_rooms' => $this->count_rooms,
           // 'square' => $this->square,
            'floor' => $this->floor,
            'floors' => $this->floors,
            //'site_id'=>$this->site_id,
            //'date' => $this->date,
        ]);
        

      //  $query->andFilterWhere(['like', 'shortdistrict', $this->shortdistrict])
        //andFilterWhere(['like', 'shortdistrict', $this->shortdistrict])
             $query->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'street', $this->street])
            //->andFilterWhere(['like', 'street2', $this->street2])
           // ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'own_or_business', $this->own_or_business])
            ->andFilterWhere(['like', 'manager', $this->manager])
            ->andFilterWhere(['like', 'coment', $this->coment])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'site', $this->site])
            ->andFilterWhere(['like', 'date', $this->date])
        
            
        
               
           ->andFilterWhere(['like', 'material', $this->material])
            
            ->andFilterWhere(['like', 'img', $this->img]);
            
            $query->orderBy('site_id DESC');




        // // grid filtering conditions
        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'site_id' => $this->site_id,
        //     'price' => $this->price,
        //     'price_m' => $this->price_m,
        //     'count_rooms' => $this->count_rooms,
        //     'square' => $this->square,
        //     'floor' => $this->floor,
        //     'floors' => $this->floors,
        //     'date' => $this->date,
        // ]);

        // $query->andFilterWhere(['like', 'shortdistrict', $this->shortdistrict])
        //     ->andFilterWhere(['like', 'phone', $this->phone])
        //     ->andFilterWhere(['like', 'currency', $this->currency])
        //     ->andFilterWhere(['like', 'type', $this->type])
        //     ->andFilterWhere(['like', 'district', $this->district])
        //     ->andFilterWhere(['like', 'street', $this->street])
        //     ->andFilterWhere(['like', 'street2', $this->street2])
        //     ->andFilterWhere(['like', 'description', $this->description])
        //     ->andFilterWhere(['like', 'state', $this->state])
        //     ->andFilterWhere(['like', 'material', $this->material])
        //     ->andFilterWhere(['like', 'own_or_business', $this->own_or_business])
        //     ->andFilterWhere(['like', 'manager', $this->manager])
        //     ->andFilterWhere(['like', 'coment', $this->coment])
        //     ->andFilterWhere(['like', 'url', $this->url])
        //     ->andFilterWhere(['like', 'site', $this->site])
        //     ->andFilterWhere(['like', 'img', $this->img]);



        //     $query->orderBy('site_id DESC');

        return $dataProvider;
    }
}
