<?php

namespace Modules\Warehouse\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;
use Zebra\Client;
use Zebra\Zpl\Builder;
use Zebra\Zpl\Image;

class Zebra extends Model
{
    use Translatable;

    /**
     * ZPL Builder
     */
    protected $builder;

    /**
     * Zebra client
     */
    protected $client;
    
    protected $table = 'warehouse__zebras';
    public $translatedAttributes = [];
    protected $fillable = ['title','description','ip','label_size_x','label_size_y','print_density','top_row','second_row','third_row','code_row','extra','default'];
    protected $cast = ['extra' => 'array','default' => 'boolean'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->builder = new Builder();
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function print($data)
    {
        $this->client()->send($this->build($data));
    }

    protected function client()
    {
        return $this->client = new Client($this->ip);
    }

    protected function build($data)
    {
        $data = $this->dataCecker($data);
        $zebra = 'XA
				^LH30,10
				^CI28^FO00,00^AD,28,
				^FH^FD'.preg_replace('/\'/', '', iconv('UTF-8', "ASCII//TRANSLIT", $data[$this->top_row])).'^FS
				^FO00,60^AD,26,
				^FD'.preg_replace('/\'/', '', iconv('UTF-8', "ASCII//TRANSLIT", $data[$this->second_row])).'^FS
				^FO00,90^AD,26,
				^FD'.preg_replace('/\'/', '', iconv('UTF-8', "ASCII//TRANSLIT", $data[$this->third_row])).'^FS
				^BY3,2,70
				^FO00,120^B3N
				^FD'.preg_replace('/\'/', '', iconv('UTF-8', "ASCII//TRANSLIT", $data[$this->code_row])).'^FS^,^XZ';
        return $this->builder->gf($zebra);
    }

    protected function dataCecker($data)
    {
        if (is_object($data)) {
            return $data->toArray();
        } elseif (is_array($data)) {
            return $data;
        }
        throw new Exception(trans('warehouse::zebra.message.no data'));
    }

    public function odloz()
    {
        return '^XA
                ^LH80,00
                ^CI28^FO0,10^AD,28,
                ^FH^FDTop row^FS
                ^FO0,60^AD,26,
                ^FDSecond Row^FS
                ^FO0,90^AD,26,
                ^FDthird rov^FS
                ^BY3,2,70
                ^FO0,120^B3N
                ^FDCode^FS^,^XZ';
    }
}
