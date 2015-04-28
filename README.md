acCouchdbPlugin
===============

An symfony 1.4 ODM plugin for CouchDB build on Doctrine 1.3 philosophy

Installation
------------

*Plugin recuperation in your symfony 1.4 project*

In root of your symfony 1.4 project

git remote add plugins/acCouchdbPlugin https://github.com/24eme/acCouchdbPlugin.git
git subtree add --prefix=plugins/acCouchdbPlugin plugins/acCouchdbPlugin master --squash

*Configuration*

Add the following line in config/ProjectConfiguration.class.php file :
  
    ...
    public function setup()
    {
      ...
      $this->enablePlugins('acCouchdbPlugin');
      ...

Configure database in config/databases.yml

    all:
      default:
        class: acCouchdbDatabase
        param:
          dsn: http://localhost:5984/
          dbname: your_database_name
