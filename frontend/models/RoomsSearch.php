<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Rooms;

/**
 * RoomsSearch represents the model behind the search form about `app\models\Rooms`.
 */
class RoomsSearch extends Rooms
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'count_rooms', 'floor', 'floors'], 'integer'],
            [['shortdistrict', 'price' , 'square' , 'price_m', 'phone', 'currency', 'type', 'district', 'street','street2', 'description', 'state', 'own_or_business', 'manager', 'coment', 'url', 'site', 'img','date','material','site_id'], 'safe'],
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
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Rooms::find();

        // add conditions that should always apply here

//$test='mimim';
//\Yii::info("own: ", var_dump($params,true));
//  $dumper = new yii\helpers\BaseVarDumper();
//    echo $dumper::dump($test, 10, true);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
              'pagination'=>array(
        'pageSize'=>10,
    ),
        ]);
       // var_dump($params);
         //    die();
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        
        
          
        
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
            //$query->orderBy('id DESC');
            
            //$query->orderBy('id DESC');
           
           
           // 
//            Yii::$app->getDb()->cache(function ($db) use ($dataProvider) { $dataProvider->prepare(); }, 10); return $this->render('index',['dataProvider'=>$dataProvider]);
//            
//            

        return $dataProvider;
    }
}