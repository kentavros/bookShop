<?php
include '../../app/lib/function.php';
class Clients extends RestServer
{
    private $model;
    private $response;

    /**
     * create obj - model & response
     * parent run method
     * Books constructor.
     */
    public function __construct()
    {
        $this->model = new ModelClients();
        $this->response = new Response();
        $this->run();
    }

    public function getClients($param)
    {
        try
        {
            if (isset($param['hash']) && isset($param['id_client']))
            {
                $result = $this->model->getClients($param);
                $result = $this->encodedData($result);
                return $this->response->serverSuccess(200, $result);
            }
            $result = $this->model->checkClients($param);
            $result = $this->encodedData($result);
            return $this->response->serverSuccess(200, $result);
        }
        catch(Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }

    public function postClients($param)
    {
        try
        {
            $result = $this->model->addClient($param);
            return $this->response->serverSuccess(200, $result);
        }
        catch (Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }

    public function putClients($param)
    {
        try
        {
//            dump($param);
//            exit();
            if (isset($param['hash']) && isset($param['id_user']))
            {
                $result = $this->model->editClients($param);
                $result = $this->encodedData($result);
                return $this->response->serverSuccess(200, $result);
            }
            $result = $this->model->loginClient($param);
            $result = $this->encodedData($result);
            return $this->response->serverSuccess(200, $result);
        }
        catch (Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }
}
$books = new Clients();