set :application, "mec"
set :domain,      "labesse.me"
set :deploy_to,   "/var/www/html/#{application}"
set :app_path,    "app"

set :repository,  "git@github.com:Eraac/FlairBuilder.git"
set :scm,         :git
set :deploy_via	, :remote_cache
set :use_composer, true

set :model_manager, "doctrine"

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :keep_releases,  3
set :shared_files, ["app/config/parameters.yml"]
set :shared_children, [app_path + "/logs", app_path + "/cache"]
set :use_sudo, false
set :user, "webadmin"
set :writable_dirs, ["app/cache", "app/logs"]
set :webserver_user, "webadmin"

default_run_options[:pty] = true
ssh_options[:port] = "2222"

# Be more verbose by uncommenting the following line
logger.level = Logger::MAX_LEVEL
