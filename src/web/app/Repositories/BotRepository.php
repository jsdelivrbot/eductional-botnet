<?php
namespace App\Repositories;

use App\Bot;
use Illuminate\Support\Str;

class BotRepository
{
  protected $bot;

  public function __construct(Bot $bot)
  {
    $this->bot = $bot;
  }

  /**
    * @param array $data
    * @return mixed
  */
  public function create(array $data) {
    $bot = new $this->bot;

    $bot->mac_address = $data['mac_address'];
    $bot->state = 'connected';
    $bot->save;

    return $bot;
  }

  /**
    * @param array $data
    * @param $id
    * @param string $attribute
    * @return mixed
  */
  public function update(array $data, $id, $attribute="id") {
    return $this->bot
      ->where($attribute, '=', $id)
      ->update($data);
  }

  /**
    * @param $id
    * @return mixed
  */
  public function getById($id)
  {
    return $this->bot
      ->findOrFail($id);
  }

  /**
    * @param $attribute
    * @param $value
    * @param array $columns
    * @return mixed
  */
  public function findBy($attribute, $value, $columns = array('*'))
  {
    return $this->bot
      ->where($attribute, '=', $value)
      ->first($columns);
  }
}