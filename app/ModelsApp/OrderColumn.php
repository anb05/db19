<?php

namespace Db19\ModelsApp;

use Illuminate\Database\Eloquent\Model;

/**
 * Db19\ModelsApp\OrderColumn
 *
 * @property string $type_name
 * @property int|null $num
 * @property int|null $date
 * @property int|null $author
 * @property int|null $header
 * @property int|null $key_words
 * @property int|null $description
 * @property int|null $number_of_copies
 * @property int|null $number_of_pages
 * @property int|null $description_copy
 * @property int|null $number_of_appendix
 * @property int|null $number_of_pages_appendix
 * @property int|null $case_number
 * @property int|null $page_in_case
 * @property int|null $relation_document
 * @property int|null $outside_num
 * @property int|null $outside_date
 * @property int|null $correspondent
 * @property int|null $return_date
 * @property-read \Db19\ModelsApp\Type $type
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\OrderColumn whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\OrderColumn whereCaseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\OrderColumn whereCorrespondent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\OrderColumn whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\OrderColumn whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\OrderColumn whereDescriptionCopy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\OrderColumn whereHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\OrderColumn whereKeyWords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\OrderColumn whereNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\OrderColumn whereNumberOfAppendix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\OrderColumn whereNumberOfCopies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\OrderColumn whereNumberOfPages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\OrderColumn whereNumberOfPagesAppendix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\OrderColumn whereOutsideDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\OrderColumn whereOutsideNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\OrderColumn wherePageInCase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\OrderColumn whereRelationDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\OrderColumn whereReturnDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\OrderColumn whereTypeName($value)
 * @mixin \Eloquent
 */
class OrderColumn extends Model
{
    protected $table = 'order_columns';

    protected $primaryKey = 'type_name';

    protected $fillable = [
        'type_name',
        'num',
        'date',
        'author',
        'header',
        'key_words',
        'description',
        'number_of_copies',
        'number_of_pages',
        'description_copy',
        'number_of_appendix',
        'number_of_pages_appendix',
        'case_number',
        'page_in_case',
        'relation_document',
        'outside_num',
        'outside_date',
        'correspondent',
        'return_date',
    ];

    public $incrementing = false;

    public $timestamps = false;

    public function type()
    {
        return $this->belongsTo('Db19\ModelsApp\Type', 'type_name', 'name');
    }
}
