<?php
namespace Zfegg\Admin\OperationLog\Controller;

use Admin\Model\OperationLogTable;
use Zend\Db\Sql\Predicate\Expression;
use Zend\Db\Sql\Select;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;


/**
 * Class OperationLogController
 *
 * @package Admin\Controller
 */
class OperationLogController extends AbstractActionController
{
    public function readAction()
    {
        /** @var \Zend\Paginator\Paginator $paginator */
        $paginator = $this->getOperationLogTable()->fetchPaginator(
            function (Select $select) {
                $select->columns(
                    array(
                        'id', 'uri', 'param', 'method', 'ip'=>new Expression("inet_ntoa(ip)"), 'time'
                    )
                )
                    ->join(
                        "admin_user", "admin_user.user_id = admin_operation_log.user_id", array(
                            'account'
                        ), 'left'
                    );
                $select->order(array('time' => 'desc'));
            }
        );
        $paginator->setCurrentPageNumber($this->getRequest()->getPost('page', 1));

        $data = $paginator->getCurrentItems()->toArray();

        return new JsonModel(
            array(
                'total' => $paginator->getTotalItemCount(),
                'data'  => $data,

            )
        );
    }

    /**
     * @return \Zend\Db\TableGateway\TableGateway
     */
    public function getOperationLogTable()
    {
        return $this->get('Zfegg\Admin\OperationLogTable');
    }
}