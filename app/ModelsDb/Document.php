<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 *
 * @package Db19\ModelsDb
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string $return_date
 * @property string $author
 * @property string $header
 * @property string $key_words
 * @property string $description
 * @property int $number_of_copies
 * @property int $number_of_pages
 * @property string $description_copy
 * @property int $number_of_appendix
 * @property int $number_of_pages_appendix
 * @property string $case_number
 * @property int $page_in_case
 * @property int|null $relation_document
 * @property int $creator_id
 * @property string $state_name
 * @property string $outside_num
 * @property string|null $outside_date
 * @property string $correspondent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Db19\ModelsDb\Appendix[] $appendices
 * @property-read \Illuminate\Database\Eloquent\Collection|\Db19\ModelsDb\Registration[] $confidentialOutputs
 * @property-read \Illuminate\Database\Eloquent\Collection|\Db19\ModelsDb\Control[] $controls
 * @property-read \Db19\ModelsDb\DocBody $docBody
 * @property-read \Db19\ModelsDb\State $documentState
 * @property-read \Illuminate\Database\Eloquent\Collection|\Db19\ModelsDb\Group[] $groups
 * @property-read \Illuminate\Database\Eloquent\Collection|\Db19\ModelsDb\Resolution[] $resolutions
 * @property-read \Db19\ModelsDb\UserDb $user
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereCaseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereCorrespondent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereDescriptionCopy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereKeyWords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereNumberOfAppendix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereNumberOfCopies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereNumberOfPages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereNumberOfPagesAppendix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereOutsideDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereOutsideNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document wherePageInCase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereRelationDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereReturnDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereStateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $hard_deletion
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Document whereHardDeletion($value)
 */
class Document extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'documents';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'return_date',
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
        'creator_id',
        'state_name',
        'outside_num',
        'outside_date',
        'correspondent',
        ];

    /**
     * This method returns a collection of Control models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function controls()
    {
        return $this->hasMany(
            '\Db19\ModelsDb\Control',
            'document_id',
            'id'
        );
    }

    /**
     * This method returns a collection of Resolution models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resolutions()
    {
        return $this->hasMany(
            '\Db19\ModelsDb\Resolution',
            'document_id',
            'id'
        );
    }

    /**
     * This method returns an object of UserDb class
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(
            '\Db19\ModelsDb\UserDb',
            'creator_id',
            'id'
        );
    }

    /**
     * This method returns an object of State class
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function documentState()
    {
        return $this->belongsTo(
            '\Db19\ModelsDb\State',
            'state_name',
            'name'
        );
    }

    /**
     * This method returns a collection of Group models
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(
            '\Db19\ModelsDb\Group',
            'document_group',
            'document_id',
            'group_name'
        );
    }

    /**
     * This method returns a collection of Appendix models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appendices()
    {
        return $this->hasMany(
            '\Db19\ModelsDb\Appendix',
            'document_id',
            'id'
        );
    }

    /**
     * This method returns a collection of DocBody models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function docBody()
    {
        return $this->hasOne(
            '\Db19\ModelsDb\DocBody',
            'document_id',
            'id'
        );
    }

    /**
     * This method returns a collection of ConfidentialOutput models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function confidentialOutputs()
    {
        return $this->hasMany(
            '\Db19\ModelsDb\Registration',
            'document_id',
            'id'
        );
    }
}
