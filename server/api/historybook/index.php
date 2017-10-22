<?php
include '../../app/lib/function.php';
class Historybook extends RestServer
{
    private $model;
    private $response;

    /**
     * create obj - model & response
     * parent run method
     * Genres constructor.
     */
    public function __construct()
    {
        $this->model = new ModelHistorybook();
        $this->response = new Response();
        $this->run();
    }

    public function postHistorybook($param)
    {
        try
        {
            $result = $this->model->addBook($param);
            return $this->response->serverSuccess(200, $result);
        }
        catch (Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }
}
$books = new Historybook();