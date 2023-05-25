<?php

namespace Hup234design\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EnquiryBlock extends Model
{
    protected $fillable = ['type', 'value'];

    public function enquiries($type, $value)
    {
        switch( $type ) {
            case "ip_address":
                return Enquiry::where('ip_address', $value);
                break;
            case "domain":
                return Enquiry::where('domain', $value);
                break;
            default:
                return Enquiry::where('email', $value);
                break;
        }
    }

    public function ipEnquiries() : HasMany
    {
        return $this->hasMany(Enquiry::class, 'ip_address', 'value' );
    }

    public function domainEnquiries() : HasMany
    {
        return $this->hasMany(Enquiry::class, 'domain', 'value' );
    }

    public function emailEnquiries() : HasMany
    {
        return $this->hasMany(Enquiry::class, 'email', 'value' );
    }

}
