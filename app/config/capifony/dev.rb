server '176.31.171.225', :app, :web, :primary => true

set  :parameters_file,       "parameters.dev.yml"
set  :default_tag,           "develop"
set  :deploy_to,             "/var/www/html/mise-en-concurrence"
