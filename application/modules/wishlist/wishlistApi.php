<?php

namespace wishlist;

/**
 * Image CMS
 * Module Wishlist
 * @property wishlist_model $wishlist_model
 */
class WishlistApi extends \wishlist\classes\BaseApi {

    public function __construct() {
        parent::__construct();
    }

    /**
     * get all public users wish lists
     * 
     * @return json
     */
    public function all() {
        parent::all();
        $data['settings'] =  $this->settings;

        if ($this->dataModel) {
             $data['data'] = $this->dataModel;
             $data['answer'] = 'success';
        } else {
             $data['errors'] = $this->errors;
             $data['answer'] = 'error';
        }
        return json_encode($data);
    }

    /**
     * add item to wish list
     * 
     * @param type $varId - current variant id 
     * @return json
     */
    public function addItem($varId) {
        parent::_addItem($varId);
        return $this->return_json();
    }

    /**
     * move item to wish list
     * 
     * @param type $varId - current variant id 
     * @param type $wish_list_id - current wish list id 
     * @return json
     */
    public function moveItem($varId, $wish_list_id) {
        parent::moveItem($varId, $wish_list_id);
        return $this->return_json();
    }

    /**
     * delete item from list
     * 
     * @param type $variant_id
     * @param type $wish_list_id
     * @return json
     */
    public function deleteItem($variant_id, $wish_list_id) {
        parent::deleteItem($variant_id, $wish_list_id);
        return $this->return_json();
    }

    /**
     * delete items from wish lists
     * 
     * @return json
     */
    public function deleteItemsByIds(){
        parent::deleteItemsByIds($items);
        return $this->return_json();
     }

     /**
      * get public wish list
      * 
      * @param type $hash
      * @return json
      */
     public function show($hash) {
         parent::show($hash);
         return $this->return_json();
    }

    /**
     * get  most viewed wish lists
     * 
     * @param type $limit
     * @return json
     */
    public function getMostViewedWishLists($limit=10){
        parent::getMostViewedWishLists($limit);
        return $this->return_json();
    }

    /**
     * get user public wish list
     * 
     * @param type $user_id
     * @return json
     */
    public function user($user_id) {
        parent::user($user_id);
        return $this->return_json();
    }

    /**
     * user update information
     * 
     * @return json
     */
    public function userUpdate() {
        parent::userUpdate();
        return $this->return_json();
    }

    /**
     * get most popular items
     * 
     * @param type $limit = 10
     * @return json
     */
    public function getMostPopularItems($limit = 10) {
        parent::getMostPopularItems($limit);
        return $this->return_json();
    }

    /**
     * create wish list
     * 
     * @return json
     */
     public function createWishList(){
        parent::createWishList();
        return $this->return_json();
    }

    /**
     * update wish list
     * 
     * @return json
     */
    public function updateWL() {
        parent::updateWL();
        return $this->return_json();
    }

    /**
     * delete wish list
     * 
     * @param type $wish_list_id
     * @return json
     */
    public function deleteWL($wish_list_id) {
       parent::deleteWL($wish_list_id);
       return $this->return_json();
    }

    /**
     * delete image
     * 
     * @return json
     */
    public function deleteImage(){
        parent::deleteImage();
        return $this->return_json();
    }

    /**
     * get wish list button
     * 
     * @param type $varId
     * @return json
     */
    public function renderWLButton($varId) {
        if($this->dx_auth->is_logged_in()){
            $data['href'] = '/wishlist/renderPopup/' . $varId;
        }else{
            $data['href'] = '/auth/login';
        }

        if (!in_array($varId, $this->userWishProducts)){
            $data['varId'] = $varId;
            $data['value'] = lang('btn_add_2_WL');
            $data['max_lists_count'] = $this->settings['maxListsCount'];
            $data['class'] = 'btn';
        }else{
            $data['varId'] = $varId;
            $data['value'] = lang('btn_already_in_WL');
            $data['max_lists_count'] = $this->settings['maxListsCount'];
            $data['class'] = 'btn inWL';
        }
        return json_encode($data);
    }


    /**
     * get popup
     * 
     * @param type $varId
     * @param type $wish_list_id
     * @return json
     */
    public function renderPopup($varId, $wish_list_id = '') {
        parent::renderPopup();
        $data['varId'] = $varId;
        $data['wish_list_id'] = $wish_list_id;
        $data['max_lists_count'] = $this->settings['maxListsCount'];
        $data['class'] = 'btn';
        if($this->dataModel){
            $data['wish_lists'] = $this->dataModel;
            $data['answer'] = 'success';
        }else{
            $data['errors'] = $this->errors;
            $data['answer'] = 'error';
        }
        return json_encode($data);
    }

    /**
     * edit wish list 
     * 
     * @param type $wish_list_id
     * @param type $userID
     * @return json
     */
    public function editWL($wish_list_id, $userID = null) {
        if (parent::renderUserWLEdit($wish_list_id, $userID)){
            $data['wishlists'] = $this->dataModel;
            $data['answer'] = 'success';
            return json_encode($data);
        }else{
            $data['answer'] = 'error';
            return json_encode($data);
        }
    }


    /**
     * upload image
     * 
     * @return json
     */
    public function do_upload() {
        parent::do_upload();
        return $this->return_json();
    }


    /**
     * return json method results 
     * 
     * @return json
     */
    private function return_json(){
        $data = array();
        if($this->dataModel){
            $data= array(
                'answer' => 'success',
                'data' => $this->dataModel
            );
        }  else {
            if($this->errors){
                 $data= array(
                    'answer' => 'error',
                    'data' => $this->errors
                );
            }
        }
        return json_encode($data);
    }

}

/* End of file wishlistApi.php */