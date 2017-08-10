<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 *
 * @package Db19\ModelsDb
 */
class Document extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'documents';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'outside_serial',
        'outside_date',
        'author',
        'header',
        'correspondent_id',
        'type_id',
        'key_words',
        'number_of_copies',
        'number_of_pages',
        'number_of_appendix',
        'number_of_pages_appendix',
        'case_number',
        'page_in_case',
        'output_document',
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
     * This method returns an object of Correspondent class
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function correspondent()
    {
        return $this->belongsTo(
            '\Db19\ModelsDb\Correspondent',
            'correspondent_id',
            'id'
        );
    }

    /**
     * This method returns an object of TypeOfDocument class
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function documentType()
    {
        return $this->belongsTo(
            '\Db19\ModelsDb\TypeOfDocument',
            'type_id',
            'id'
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function docBody()
    {
        return $this->hasMany(
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
            '\Db19\ModelsDb\ConfidentialOutput',
            'document_id',
            'id'
        );
    }

    /**
     * This method returns a collection of NoConfidentialOutput models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function noConfidentialOutputs()
    {
        return $this->hasMany(
            '\Db19\ModelsDb\NoConfidentialOutput',
            'document_id',
            'id'
        );
    }

    /**
     * This method returns a collection of ConfidentialInventory models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function confidentialInventory()
    {
        return $this->hasMany(
            '\Db19\ModelsDb\ConfidentialInventory',
            'document_id',
            'id'
        );
    }

    /**
     * This method returns a collection of NoConfidentialInventory models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function noConfidentialInventory()
    {
        return $this->hasMany(
            '\Db19\ModelsDb\NoConfidentialInventory',
            'document_id',
            'id'
        );
    }

    /**
     * This method returns a collection of ConfidentialNumber models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function confidentialNumbers()
    {
        return $this->hasMany(
            '\Db19\ModelsDb\ConfidentialNumber',
            'document_id',
            'id'
        );
    }

    /**
     * This method returns a collection of NoConfidentialNumber models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function noConfidentialNumbers()
    {
        return $this->hasMany(
            '\Db19\ModelsDb\NoConfidentialNumber',
            'document_id',
            'id'
        );
    }

    /**
     * This method returns a collection of ConfidentialDisk models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function confidentialDisk()
    {
        return $this->hasMany(
            '\Db19\ModelsDb\ConfidentialDisk',
            'document_id',
            'id'
        );
    }

    /**
     * This method returns a collection of NoConfidentialDisk models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function noConfidentialDisk()
    {
        return $this->hasMany(
            '\Db19\ModelsDb\NoConfidentialDisk',
            'document_id',
            'id'
        );
    }
}
