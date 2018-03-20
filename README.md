# Tematres Information Service for CollectiveAccess

[InformationService](http://docs.collectiveaccess.org/wiki/Information_Services) for [CollectiveAccess](https://github.com/collectiveaccess/providence). Queries the Tematres API and outputs the first page of hits to choose from. Adds URL. 

## Template of this repository

Structure, folders and documentation here mimics the IconClass Information Service by Karl Becker : https://github.com/karbecker/ca_iconclass

## Installation

- Copy the Tematres.php to `your_providence_install/app/lib/core/Plugins/InformationService/Tematres.php`
- Create a Metadata Element with Tematres as Information Service, let's call it "Tematres Vocabulary", having tematres_vocab as its idno.
- Edit the URL of the service

## Pawtucket2

Call it in [Pawtucket2](https://github.com/collectiveaccess/pawtucket2), the CA Frontend (for instance in a ca_objects_default_html.php if the Metadata Element is called tematres_vocab (depending on what you chose before) : 

    {{{<a href="^ca_objects.tematres_vocab.url">^ca_objects.tematres_vocab</a>}}}

#### See http://r020.com.ar/tematres/demo/api/ and http://www.vocabularyserver.com/ for more Information about the API.

## Videos showing the vocabulary in tematres and configured in CollectiveAccess Providence

Tematres : vocabulary inside the Tematres web app interface
	![Tematres : vocabulary inside the Tematres web app interface](https://github.com/ideesculture/ca_tematres/blob/master/screenshots/terme-thesaurus-tematres.gif?raw=true)

Tematres : information service inside CollectiveAccess Providence
	![Tematres : information service inside CollectiveAccess Providence](https://github.com/ideesculture/ca_tematres/blob/master/screenshots/information-service-tematres.gif?raw=true)
