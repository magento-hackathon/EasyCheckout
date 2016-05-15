<?php

namespace Hackathon\Easycheckout\Plugin;

class LinkPlugin
{
    public function afterGetCheckoutUrl($subject,$result)
    {   
        return $subject->getUrl('easycheckout');
    }
    
}