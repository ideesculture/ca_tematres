# Iconclass Information Service for CollectiveAccess

[InformationService](http://docs.collectiveaccess.org/wiki/Information_Services) for [CollectiveAccess](https://github.com/collectiveaccess/providence). Queries the Iconclass API and outputs the first page of hits to choose from. Adds URL. 

## Installation

- Copy the Iconclass.php to `your_providence_install/app/lib/core/Plugins/InformationService/Iconclass.php`
- Create a Metadata Element with Iconclass as Information Service

## Pawtucket2

Call it in [Pawtucket2](https://github.com/collectiveaccess/pawtucket2), the CA Frontend (for instance in a ca_objects_default_html.php if the Metadata Element is called `Iconclass`: 

    {{{<a href="^ca_objects.iconclass.url">^ca_objects.iconclass</a>}}}

## Change Language

Also, if you want to change the query language from German to English, change lin 98 from

    'label' => $va_result['txt']['de'],
    
to

    'label' => $va_result['txt']['en'],

#### See http://www.iconclass.org/?place=msg%2Ficonclass%2F72FpG9xUE30%2FcwZ9b1VEGAAJ for more Information about the API.

## Video showing the Plugin in action

![show](https://raw.githubusercontent.com/kbecker87/ca_iconclass/master/screenshots/Iconclass.gif)
