server 'eveiltoi.fr', :app, :web, :primary => true

set :use_set_permissions, false

set :parameters_dir,        "app/config/capifony"
set :parameters_file,       "parameters.prod.yml"

set :default_tag,          "master"
set :domain,               "eveiltoi.fr"
set :deploy_to,            "/var/www/eveiltoi-site"
