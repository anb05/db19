<?php

namespace Db19\ModelsApp;

use Illuminate\Database\Eloquent\Model;

/**
 * Db19\ModelsApp\Type
 *
 * @property string $name
 * @property string|null $num
 * @property string|null $date
 * @property string|null $author
 * @property string|null $header
 * @property string|null $key_words
 * @property string|null $description
 * @property string|null $number_of_copies
 * @property string|null $number_of_pages
 * @property string|null $description_copy
 * @property string|null $number_of_appendix
 * @property string|null $number_of_pages_appendix
 * @property string|null $case_number
 * @property string|null $page_in_case
 * @property string|null $relation_document
 * @property string|null $outside_num
 * @property string|null $outside_date
 * @property string|null $correspondent
 * @property string|null $return_date
 * @property-read \Db19\ModelsApp\OrderColumn $type
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereCaseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereCorrespondent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereDescriptionCopy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereKeyWords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereNumberOfAppendix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereNumberOfCopies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereNumberOfPages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereNumberOfPagesAppendix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereOutsideDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereOutsideNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type wherePageInCase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereRelationDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereReturnDate($value)
 * @mixin \Eloquent
 * @property string $alias
 * @property string $native_name
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Type whereNativeName($value)
 */
class Type extends Model
{
    protected $table = 'types';

    protected $primaryKey = 'name';

    protected $fillable = [
        'name',
        'alias',
        'native_name',
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
        return $this->hasOne('Db19\ModelsApp\OrderColumn', 'type_name', 'name');
    }
}
