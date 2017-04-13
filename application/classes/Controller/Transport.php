<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @copyright Khaydarov Murod
 * https://github.com/khaydarov
 */

class Controller_Transport extends Dispatch {

    private $transportResponse = array(
        'success' => 0
    );

    private $files  = null;
    private $type   = null;
    private $params = null;

    private $typesAvailable = array(
        Model_Uploader::PROFILE_AVATAR,
        Model_Uploader::PROFILE_BRANDING,
        Model_Uploader::ORGANIZATION_LOGO,
        Model_Uploader::ORGANIZATION_BRANDING,
        Model_Uploader::EVENT_BRANDING,
        Model_Uploader::PARTICIPANTS_PHOTO
    );

    /** File transport module */
    public function before()
    {
        $this->auto_render = false;
        parent::before();
    }

    public function action_upload()
    {
        $this->files    = Arr::get($_FILES, 'files');
        $this->type     = $this->request->param('type');
        $this->params   = json_decode(Arr::get($_POST, 'params'));

        $file = new Model_Uploader();

        if ( !$this->check() ){
            goto finish;
        }

        $uploadedFile = $file->upload($this->type, $this->files, $this->user->id, $this->params);

        if ( $uploadedFile ) {
            $this->transportResponse['success'] = 1;
            $this->transportResponse['data'] = array(
                'url'       => $uploadedFile['filepath'],
                'name'      => $uploadedFile['filename'],
            );
        } else {
            $this->transportResponse['message'] = 'Error while uploading';
        }

        finish:
        $response = @json_encode($this->transportResponse);
        $this->auto_render = false;
        $this->response->body($response);
    }

    /**
     * Make necessary verifications
     * @return Boolean
     */
    private function check()
    {
        if (!$this->user->id) {
            $this->transportResponse['message'] = 'Access denied';
            return false;
        }
        if (!$this->type) {
            $this->transportResponse['message'] = 'Transport type missed';
            return false;
        }
        if ( !in_array($this->type, $this->typesAvailable) ){
            $this->transportResponse['message'] = 'Wrong type passed';
            return false;
        }
        if (!Upload::size($this->files, '2M')) {
            $this->transportResponse['message'] = 'File size exceeded limit';
            return false;
        }
        if (!$this->files){
            $this->transportResponse['message'] = 'File was not transferred';
            return false;
        }
        if (!Upload::not_empty($this->files)){
            $this->transportResponse['message'] = 'File is empty';
            return false;
        }
        if (!Upload::valid($this->files)){
            $this->transportResponse['message'] = 'Uploaded file is damaged';
            return false;
        }
        return true;
    }
}