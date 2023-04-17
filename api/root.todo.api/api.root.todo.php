<?php
header("Content-Type:application/Json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require_once '../../core/init.php';

$HASH = new Hash;

// echo $HASH->encryptAES("todo-api-data");

# Check Request Method Origin
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

  $headers = Functions::getRequestHeaders();

  if (!$headers):
   
    $token = Functions::getBearerAuthValue($headers);
    $access_data = TODO_CONTROLLER::checkToken($token);
    
    # Check Valid Token :: Access Data
    if (!$access_data):

      if (Input::checkInput('request', 'post', 1) && Input::checkInput('webToken', 'post', 1)):
        // $_REQUEST_ = Input::get('request', 'post');
        $_REQUEST_ = $HASH->decryptAES(Input::get('request', 'post'));

        if ($_REQUEST_):
          switch ($_REQUEST_):

            # todo
            case 'todo-api-creation':
              $form = \TODO_CONTROLLER::record_todo();
              if ($form->ERRORS == false):
                $response['status'] = 'SUCCESS';
                $response['message'] = 'Operation success!';
              else:
                $response['status'] = 'FAILLURE';
                $response['message'] = $form->ERRORS_SCRIPT;
              endif;
              Json::echo ($response);
              break;

              

            case 'todo-api-update':
              $form = \TODO_CONTROLLER::edit_todo();
              if ($form->ERRORS == false):
                $response['status'] = 'SUCCESS';
                $response['message'] = 'Operation success!';
              else:
                $response['status'] = 'FAILLURE';
                $response['message'] = $form->ERRORS_SCRIPT;
              endif;
              Json::echo ($response);
              break;

            case 'todo-api-list':
              $_LIST_DATA_ = \TODO_CONTROLLER::gettodos();
              if ($_LIST_DATA_):
                $response['status'] = 'SUCCESS';
                $response['message'] = 'SUCCESS';
                $response['data'] = $_LIST_DATA_;
              else:
                $response['status'] = 'FAILLURE';
                $response['message'] = 'EMPTY';
              endif;
              Json::echo ($response);
              break;

            case 'todo-api-data':
              if (Input::checkInput('_id_', 'post', 1)):
                $_ID_ = $HASH->decryptAES(Input::get('_id_', 'post'));
                $_DATA_ = \TODO_CONTROLLER::getInfotodoByID($_ID_);
                if ($_DATA_):
                  $response['status'] = 'SUCCESS';
                  $response['message'] = 'Operation success!';
                  $response['data'] = $_DATA_;
                else:
                  $response['status'] = 'FAILLURE';
                  $response['message'] = $form->ERRORS_SCRIPT;
                endif;
              else:
                $response['status'] = 'FAILLURE';
                $response['message'] = "Required param";
              endif;
              Json::echo ($response);
              break;

            case 'todo-api-activate':
              Input::put('todo-status', 'post', 'ACTIVE');
              $form = \TODO_CONTROLLER::change_status_todo();
              if ($form->ERRORS == false):
                $response['status'] = 'SUCCESS';
                $response['message'] = 'Operation success!';
              else:
                $response['status'] = 'FAILLURE';
                $response['message'] = $form->ERRORS_SCRIPT;
              endif;
              Json::echo ($response);
              break;

            case 'todo-api-deactivate':
              Input::put('todo-status', 'post', 'DEACTIVE');
              $form = \TODO_CONTROLLER::change_status_todo();
              if ($form->ERRORS == false):
                $response['status'] = 'SUCCESS';
                $response['message'] = 'Operation success!';
              else:
                $response['status'] = 'FAILLURE';
                $response['message'] = $form->ERRORS_SCRIPT;
              endif;
              Json::echo ($response);
              break;

              //delete
            case 'todo-api-delete':
              Input::put('update-status', 'post', 'DELETED');
              $_todo_ID= $HASH->decryptAES(Input::get('_id_', 'post'));
              $form = \TODO_CONTROLLER::delete_todo($_todo_ID);
              if ($form->ERRORS == false):
                $response['status'] = 'SUCCESS';
                $response['message'] = 'Operation success!';
              else:
                $response['status'] = 'FAILLURE';
                $response['message'] = $form->ERRORS_SCRIPT;
              endif;
              Json::echo ($response);
              break;






                
            default:
              $response['status'] = 1011;
              $response['message'] = 'INVALID_REQUEST';
              Json::echo ($response);
              break;

          endswitch;
        else:
          $response['status'] = 1011;
          $response['message'] = 'INVALID_REQUEST';
          Json::echo ($response);
        endif;

      endif;
    endif;
  endif;

endif;
?>