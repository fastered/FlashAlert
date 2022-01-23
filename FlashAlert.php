<?php
/**
 * Created by PhpStorm.
 * User: Valera
 * Date: 22.01.2022
 * Time: 14:43
 */

class FlashAlert
{
    protected $alert;

    function __set($name, $value)
    {
        //$this->alert[$name] = $value;
        $this->set($name,$value);
    }
    function __get($name)
    {
        return  $this->get($name);
    }


    /**
     * @param $types
     * @return array
     */
    protected function return_array_if_is_not($types)
        {
            if(empty($types)){
                $types = $this->types;
            }else{
                if (!is_array($types)){
                    $types=[$types];
                }
            }
            return $types;
        }

    /**
     * @return string
     */
    public function get_link_bootstrap5()
    {
        return ' <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">';

    }

    /**
     * @param $type
     * @return bool
     */
    protected function isset_alert($type)
    {
        if(isset($_SESSION['alert'][$type])){
            return true;
        }
    return false;
    }

    protected $types = [
        'primary',
        'secondary',
        'success',
        'danger',
        'warning',
        'info',
        'light',
        'dark'
    ];

    /**
     * @param $type
     */
    protected function check_type($type)
        {
            if (!in_array($type,$this->types)){
                die('Невозможный параметр $type ('.$type.'), пожалуйста, используйте один из следующих элементах: '.rtrim(implode(', ',$this->types),', '));
            }
        }


    /**
     * @param $type - тип флэш сообшения,
     *возможные 'primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'.
     * @param $message - Сообщение которое нужно выводить.
     * @param bool $rewrite - указывать true если нужно переписать сообщение которое уже есть.
     */
    public function set($type, $message, $rewrite = false)
    {
       $this->check_type($type);

        if($this->isset_alert($type) and !$rewrite){
            $_SESSION['alert'][$type].= '<br>'.$message;
        }else{
            $_SESSION['alert'][$type] = $message;
        }


    }


    /**
     * @param $type - тип флэш сообшения, можно передать 1 параметр как строку, или несколько как массив с парамметри
     * возможные ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark']
     * вернет все если ничего не указать.
     * @return string возвращает flash сообщения если они есть
     */
    public function get($type = '')
    {
        $types = $this->return_array_if_is_not($type);
        $alert='';
        foreach ($types as $type){
            $this->check_type($type);
            if(isset($_SESSION['alert'][$type])){
                $alert.='<div class="alert alert-'.$type.'" role="alert">'.$_SESSION['alert'][$type].'</div>';
                unset($_SESSION['alert'][$type]);

            }
        }
        return $alert;

    }


    /**
     * @param string $type или массив
     * @return bool
     */
    public  function delete($type = '')
    {
        if (empty($type)){
            unset($_SESSION['alert']);
            return true;
        }
        $types = $this->return_array_if_is_not($type);
        foreach ($types as $type) {
            $this->check_type($type);
            unset($_SESSION['alert'][$type]);
        }
    }

}