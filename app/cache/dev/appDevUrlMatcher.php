<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/j')) {
            // _assetic_7989b3b
            if ($pathinfo === '/javascripts/inscription.js') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => '7989b3b',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_7989b3b',);
            }

            // _assetic_d7f7108
            if ($pathinfo === '/js/d7f7108.js') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'd7f7108',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_d7f7108',);
            }

        }

        // _assetic_c3185e8
        if ($pathinfo === '/css/style.css') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 'c3185e8',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_c3185e8',);
        }

        // _assetic_5829438
        if ($pathinfo === '/javascripts/main.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 5829438,  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_5829438',);
        }

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/admin/flair')) {
            if (0 === strpos($pathinfo, '/admin/flair/user')) {
                if (0 === strpos($pathinfo, '/admin/flair/user/organisme')) {
                    // admin_flair_user_organisme_list
                    if ($pathinfo === '/admin/flair/user/organisme/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'admin.organisme',  '_sonata_name' => 'admin_flair_user_organisme_list',  '_route' => 'admin_flair_user_organisme_list',);
                    }

                    // admin_flair_user_organisme_batch
                    if ($pathinfo === '/admin/flair/user/organisme/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'admin.organisme',  '_sonata_name' => 'admin_flair_user_organisme_batch',  '_route' => 'admin_flair_user_organisme_batch',);
                    }

                    // admin_flair_user_organisme_delete
                    if (preg_match('#^/admin/flair/user/organisme/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_organisme_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'admin.organisme',  '_sonata_name' => 'admin_flair_user_organisme_delete',));
                    }

                    // admin_flair_user_organisme_show
                    if (preg_match('#^/admin/flair/user/organisme/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_organisme_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'admin.organisme',  '_sonata_name' => 'admin_flair_user_organisme_show',));
                    }

                    // admin_flair_user_organisme_export
                    if ($pathinfo === '/admin/flair/user/organisme/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'admin.organisme',  '_sonata_name' => 'admin_flair_user_organisme_export',  '_route' => 'admin_flair_user_organisme_export',);
                    }

                }

                if (0 === strpos($pathinfo, '/admin/flair/user/prestataire')) {
                    // admin_flair_user_prestataire_list
                    if ($pathinfo === '/admin/flair/user/prestataire/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'admin.prestataire',  '_sonata_name' => 'admin_flair_user_prestataire_list',  '_route' => 'admin_flair_user_prestataire_list',);
                    }

                    // admin_flair_user_prestataire_batch
                    if ($pathinfo === '/admin/flair/user/prestataire/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'admin.prestataire',  '_sonata_name' => 'admin_flair_user_prestataire_batch',  '_route' => 'admin_flair_user_prestataire_batch',);
                    }

                    // admin_flair_user_prestataire_delete
                    if (preg_match('#^/admin/flair/user/prestataire/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_prestataire_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'admin.prestataire',  '_sonata_name' => 'admin_flair_user_prestataire_delete',));
                    }

                    // admin_flair_user_prestataire_show
                    if (preg_match('#^/admin/flair/user/prestataire/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_prestataire_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'admin.prestataire',  '_sonata_name' => 'admin_flair_user_prestataire_show',));
                    }

                    // admin_flair_user_prestataire_export
                    if ($pathinfo === '/admin/flair/user/prestataire/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'admin.prestataire',  '_sonata_name' => 'admin_flair_user_prestataire_export',  '_route' => 'admin_flair_user_prestataire_export',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/admin/flair/core')) {
                if (0 === strpos($pathinfo, '/admin/flair/core/consultation')) {
                    // admin_flair_core_consultation_list
                    if ($pathinfo === '/admin/flair/core/consultation/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'admin.consultation',  '_sonata_name' => 'admin_flair_core_consultation_list',  '_route' => 'admin_flair_core_consultation_list',);
                    }

                    // admin_flair_core_consultation_batch
                    if ($pathinfo === '/admin/flair/core/consultation/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'admin.consultation',  '_sonata_name' => 'admin_flair_core_consultation_batch',  '_route' => 'admin_flair_core_consultation_batch',);
                    }

                    // admin_flair_core_consultation_delete
                    if (preg_match('#^/admin/flair/core/consultation/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_core_consultation_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'admin.consultation',  '_sonata_name' => 'admin_flair_core_consultation_delete',));
                    }

                    // admin_flair_core_consultation_show
                    if (preg_match('#^/admin/flair/core/consultation/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_core_consultation_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'admin.consultation',  '_sonata_name' => 'admin_flair_core_consultation_show',));
                    }

                    // admin_flair_core_consultation_export
                    if ($pathinfo === '/admin/flair/core/consultation/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'admin.consultation',  '_sonata_name' => 'admin_flair_core_consultation_export',  '_route' => 'admin_flair_core_consultation_export',);
                    }

                }

                if (0 === strpos($pathinfo, '/admin/flair/core/reponse')) {
                    // admin_flair_core_reponse_list
                    if ($pathinfo === '/admin/flair/core/reponse/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'admin.proposition',  '_sonata_name' => 'admin_flair_core_reponse_list',  '_route' => 'admin_flair_core_reponse_list',);
                    }

                    // admin_flair_core_reponse_batch
                    if ($pathinfo === '/admin/flair/core/reponse/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'admin.proposition',  '_sonata_name' => 'admin_flair_core_reponse_batch',  '_route' => 'admin_flair_core_reponse_batch',);
                    }

                    // admin_flair_core_reponse_delete
                    if (preg_match('#^/admin/flair/core/reponse/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_core_reponse_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'admin.proposition',  '_sonata_name' => 'admin_flair_core_reponse_delete',));
                    }

                    // admin_flair_core_reponse_show
                    if (preg_match('#^/admin/flair/core/reponse/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_core_reponse_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'admin.proposition',  '_sonata_name' => 'admin_flair_core_reponse_show',));
                    }

                    // admin_flair_core_reponse_export
                    if ($pathinfo === '/admin/flair/core/reponse/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'admin.proposition',  '_sonata_name' => 'admin_flair_core_reponse_export',  '_route' => 'admin_flair_core_reponse_export',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/admin/flair/user/categorie')) {
                if (0 === strpos($pathinfo, '/admin/flair/user/categorieorganisme')) {
                    // admin_flair_user_categorieorganisme_list
                    if ($pathinfo === '/admin/flair/user/categorieorganisme/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'admin.categorie_organisme',  '_sonata_name' => 'admin_flair_user_categorieorganisme_list',  '_route' => 'admin_flair_user_categorieorganisme_list',);
                    }

                    // admin_flair_user_categorieorganisme_create
                    if ($pathinfo === '/admin/flair/user/categorieorganisme/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'admin.categorie_organisme',  '_sonata_name' => 'admin_flair_user_categorieorganisme_create',  '_route' => 'admin_flair_user_categorieorganisme_create',);
                    }

                    // admin_flair_user_categorieorganisme_batch
                    if ($pathinfo === '/admin/flair/user/categorieorganisme/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'admin.categorie_organisme',  '_sonata_name' => 'admin_flair_user_categorieorganisme_batch',  '_route' => 'admin_flair_user_categorieorganisme_batch',);
                    }

                    // admin_flair_user_categorieorganisme_edit
                    if (preg_match('#^/admin/flair/user/categorieorganisme/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieorganisme_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'admin.categorie_organisme',  '_sonata_name' => 'admin_flair_user_categorieorganisme_edit',));
                    }

                    // admin_flair_user_categorieorganisme_delete
                    if (preg_match('#^/admin/flair/user/categorieorganisme/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieorganisme_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'admin.categorie_organisme',  '_sonata_name' => 'admin_flair_user_categorieorganisme_delete',));
                    }

                    // admin_flair_user_categorieorganisme_show
                    if (preg_match('#^/admin/flair/user/categorieorganisme/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieorganisme_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'admin.categorie_organisme',  '_sonata_name' => 'admin_flair_user_categorieorganisme_show',));
                    }

                    // admin_flair_user_categorieorganisme_export
                    if ($pathinfo === '/admin/flair/user/categorieorganisme/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'admin.categorie_organisme',  '_sonata_name' => 'admin_flair_user_categorieorganisme_export',  '_route' => 'admin_flair_user_categorieorganisme_export',);
                    }

                    // admin_flair_user_categorieorganisme_categorieorganisme_list
                    if (preg_match('#^/admin/flair/user/categorieorganisme/(?P<id>[^/]++)/categorieorganisme/list$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieorganisme_categorieorganisme_list')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'admin.categorie_organisme|admin.souscategorie_organisme',  '_sonata_name' => 'admin_flair_user_categorieorganisme_categorieorganisme_list',));
                    }

                    // admin_flair_user_categorieorganisme_categorieorganisme_create
                    if (preg_match('#^/admin/flair/user/categorieorganisme/(?P<id>[^/]++)/categorieorganisme/create$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieorganisme_categorieorganisme_create')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'admin.categorie_organisme|admin.souscategorie_organisme',  '_sonata_name' => 'admin_flair_user_categorieorganisme_categorieorganisme_create',));
                    }

                    // admin_flair_user_categorieorganisme_categorieorganisme_batch
                    if (preg_match('#^/admin/flair/user/categorieorganisme/(?P<id>[^/]++)/categorieorganisme/batch$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieorganisme_categorieorganisme_batch')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'admin.categorie_organisme|admin.souscategorie_organisme',  '_sonata_name' => 'admin_flair_user_categorieorganisme_categorieorganisme_batch',));
                    }

                    // admin_flair_user_categorieorganisme_categorieorganisme_edit
                    if (preg_match('#^/admin/flair/user/categorieorganisme/(?P<id>[^/]++)/categorieorganisme/(?P<childId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieorganisme_categorieorganisme_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'admin.categorie_organisme|admin.souscategorie_organisme',  '_sonata_name' => 'admin_flair_user_categorieorganisme_categorieorganisme_edit',));
                    }

                    // admin_flair_user_categorieorganisme_categorieorganisme_delete
                    if (preg_match('#^/admin/flair/user/categorieorganisme/(?P<id>[^/]++)/categorieorganisme/(?P<childId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieorganisme_categorieorganisme_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'admin.categorie_organisme|admin.souscategorie_organisme',  '_sonata_name' => 'admin_flair_user_categorieorganisme_categorieorganisme_delete',));
                    }

                    // admin_flair_user_categorieorganisme_categorieorganisme_show
                    if (preg_match('#^/admin/flair/user/categorieorganisme/(?P<id>[^/]++)/categorieorganisme/(?P<childId>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieorganisme_categorieorganisme_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'admin.categorie_organisme|admin.souscategorie_organisme',  '_sonata_name' => 'admin_flair_user_categorieorganisme_categorieorganisme_show',));
                    }

                    // admin_flair_user_categorieorganisme_categorieorganisme_export
                    if (preg_match('#^/admin/flair/user/categorieorganisme/(?P<id>[^/]++)/categorieorganisme/export$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieorganisme_categorieorganisme_export')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'admin.categorie_organisme|admin.souscategorie_organisme',  '_sonata_name' => 'admin_flair_user_categorieorganisme_categorieorganisme_export',));
                    }

                }

                if (0 === strpos($pathinfo, '/admin/flair/user/categorieprestataire')) {
                    // admin_flair_user_categorieprestataire_list
                    if ($pathinfo === '/admin/flair/user/categorieprestataire/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'admin.categorie_prestataire',  '_sonata_name' => 'admin_flair_user_categorieprestataire_list',  '_route' => 'admin_flair_user_categorieprestataire_list',);
                    }

                    // admin_flair_user_categorieprestataire_create
                    if ($pathinfo === '/admin/flair/user/categorieprestataire/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'admin.categorie_prestataire',  '_sonata_name' => 'admin_flair_user_categorieprestataire_create',  '_route' => 'admin_flair_user_categorieprestataire_create',);
                    }

                    // admin_flair_user_categorieprestataire_batch
                    if ($pathinfo === '/admin/flair/user/categorieprestataire/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'admin.categorie_prestataire',  '_sonata_name' => 'admin_flair_user_categorieprestataire_batch',  '_route' => 'admin_flair_user_categorieprestataire_batch',);
                    }

                    // admin_flair_user_categorieprestataire_edit
                    if (preg_match('#^/admin/flair/user/categorieprestataire/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieprestataire_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'admin.categorie_prestataire',  '_sonata_name' => 'admin_flair_user_categorieprestataire_edit',));
                    }

                    // admin_flair_user_categorieprestataire_delete
                    if (preg_match('#^/admin/flair/user/categorieprestataire/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieprestataire_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'admin.categorie_prestataire',  '_sonata_name' => 'admin_flair_user_categorieprestataire_delete',));
                    }

                    // admin_flair_user_categorieprestataire_show
                    if (preg_match('#^/admin/flair/user/categorieprestataire/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieprestataire_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'admin.categorie_prestataire',  '_sonata_name' => 'admin_flair_user_categorieprestataire_show',));
                    }

                    // admin_flair_user_categorieprestataire_export
                    if ($pathinfo === '/admin/flair/user/categorieprestataire/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'admin.categorie_prestataire',  '_sonata_name' => 'admin_flair_user_categorieprestataire_export',  '_route' => 'admin_flair_user_categorieprestataire_export',);
                    }

                    // admin_flair_user_categorieprestataire_categorieprestataire_list
                    if (preg_match('#^/admin/flair/user/categorieprestataire/(?P<id>[^/]++)/categorieprestataire/list$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieprestataire_categorieprestataire_list')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'admin.categorie_prestataire|admin.souscategorie_prestataire',  '_sonata_name' => 'admin_flair_user_categorieprestataire_categorieprestataire_list',));
                    }

                    // admin_flair_user_categorieprestataire_categorieprestataire_create
                    if (preg_match('#^/admin/flair/user/categorieprestataire/(?P<id>[^/]++)/categorieprestataire/create$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieprestataire_categorieprestataire_create')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'admin.categorie_prestataire|admin.souscategorie_prestataire',  '_sonata_name' => 'admin_flair_user_categorieprestataire_categorieprestataire_create',));
                    }

                    // admin_flair_user_categorieprestataire_categorieprestataire_batch
                    if (preg_match('#^/admin/flair/user/categorieprestataire/(?P<id>[^/]++)/categorieprestataire/batch$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieprestataire_categorieprestataire_batch')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'admin.categorie_prestataire|admin.souscategorie_prestataire',  '_sonata_name' => 'admin_flair_user_categorieprestataire_categorieprestataire_batch',));
                    }

                    // admin_flair_user_categorieprestataire_categorieprestataire_edit
                    if (preg_match('#^/admin/flair/user/categorieprestataire/(?P<id>[^/]++)/categorieprestataire/(?P<childId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieprestataire_categorieprestataire_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'admin.categorie_prestataire|admin.souscategorie_prestataire',  '_sonata_name' => 'admin_flair_user_categorieprestataire_categorieprestataire_edit',));
                    }

                    // admin_flair_user_categorieprestataire_categorieprestataire_delete
                    if (preg_match('#^/admin/flair/user/categorieprestataire/(?P<id>[^/]++)/categorieprestataire/(?P<childId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieprestataire_categorieprestataire_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'admin.categorie_prestataire|admin.souscategorie_prestataire',  '_sonata_name' => 'admin_flair_user_categorieprestataire_categorieprestataire_delete',));
                    }

                    // admin_flair_user_categorieprestataire_categorieprestataire_show
                    if (preg_match('#^/admin/flair/user/categorieprestataire/(?P<id>[^/]++)/categorieprestataire/(?P<childId>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieprestataire_categorieprestataire_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'admin.categorie_prestataire|admin.souscategorie_prestataire',  '_sonata_name' => 'admin_flair_user_categorieprestataire_categorieprestataire_show',));
                    }

                    // admin_flair_user_categorieprestataire_categorieprestataire_export
                    if (preg_match('#^/admin/flair/user/categorieprestataire/(?P<id>[^/]++)/categorieprestataire/export$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_flair_user_categorieprestataire_categorieprestataire_export')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'admin.categorie_prestataire|admin.souscategorie_prestataire',  '_sonata_name' => 'admin_flair_user_categorieprestataire_categorieprestataire_export',));
                    }

                }

            }

        }

        if (0 === strpos($pathinfo, '/mo')) {
            if (0 === strpos($pathinfo, '/mon-compte')) {
                // flair_user_profil_see
                if ($pathinfo === '/mon-compte') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_flair_user_profil_see;
                    }

                    return array (  '_controller' => 'Flair\\UserBundle\\Controller\\ProfilController::afficherAction',  '_route' => 'flair_user_profil_see',);
                }
                not_flair_user_profil_see:

                if (0 === strpos($pathinfo, '/mon-compte/mo')) {
                    // flair_user_profil_edit
                    if ($pathinfo === '/mon-compte/modifier') {
                        if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                            goto not_flair_user_profil_edit;
                        }

                        return array (  '_controller' => 'Flair\\UserBundle\\Controller\\ProfilController::modifierAction',  '_route' => 'flair_user_profil_edit',);
                    }
                    not_flair_user_profil_edit:

                    // flair_user_profil_password
                    if ($pathinfo === '/mon-compte/mot-de-passe') {
                        return array (  '_controller' => 'Flair\\UserBundle\\Controller\\ProfilController::motdepasseAction',  '_route' => 'flair_user_profil_password',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/mot-de-passe-oublie')) {
                // flair_user_password_forget
                if ($pathinfo === '/mot-de-passe-oublie') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_flair_user_password_forget;
                    }

                    return array (  '_controller' => 'Flair\\UserBundle\\Controller\\SecurityController::motdepasseOublieAction',  '_route' => 'flair_user_password_forget',);
                }
                not_flair_user_password_forget:

                // flair_user_password_reset
                if (preg_match('#^/mot\\-de\\-passe\\-oublie/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_flair_user_password_reset;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'flair_user_password_reset')), array (  '_controller' => 'Flair\\UserBundle\\Controller\\SecurityController::motdepasseResetAction',));
                }
                not_flair_user_password_reset:

            }

        }

        if (0 === strpos($pathinfo, '/inscription')) {
            // flair_user_inscription_organisme
            if ($pathinfo === '/inscription/organisme') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_flair_user_inscription_organisme;
                }

                return array (  '_controller' => 'Flair\\UserBundle\\Controller\\InscriptionController::inscriptionOrganismeAction',  '_route' => 'flair_user_inscription_organisme',);
            }
            not_flair_user_inscription_organisme:

            // flair_user_confirmation_email
            if (0 === strpos($pathinfo, '/inscription/validate') && preg_match('#^/inscription/validate/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_flair_user_confirmation_email;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'flair_user_confirmation_email')), array (  '_controller' => 'Flair\\UserBundle\\Controller\\InscriptionController::confirmationEmailAction',));
            }
            not_flair_user_confirmation_email:

        }

        if (0 === strpos($pathinfo, '/mes-invitations')) {
            // flair_user_invitation_list
            if ($pathinfo === '/mes-invitations') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_flair_user_invitation_list;
                }

                return array (  '_controller' => 'Flair\\UserBundle\\Controller\\InvitationController::listerAction',  '_route' => 'flair_user_invitation_list',);
            }
            not_flair_user_invitation_list:

            // flair_user_invitation_send
            if ($pathinfo === '/mes-invitations/inviter') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_flair_user_invitation_send;
                }

                return array (  '_controller' => 'Flair\\UserBundle\\Controller\\InvitationController::sendAction',  '_route' => 'flair_user_invitation_send',);
            }
            not_flair_user_invitation_send:

        }

        // flair_user_invitation_accept
        if (0 === strpos($pathinfo, '/invitation') && preg_match('#^/invitation/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_flair_user_invitation_accept;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'flair_user_invitation_accept')), array (  '_controller' => 'Flair\\UserBundle\\Controller\\InvitationController::acceptAction',));
        }
        not_flair_user_invitation_accept:

        // flair_user_invitation_renew
        if (0 === strpos($pathinfo, '/mes-invitations/renew') && preg_match('#^/mes\\-invitations/renew/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_flair_user_invitation_renew;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'flair_user_invitation_renew')), array (  '_controller' => 'Flair\\UserBundle\\Controller\\InvitationController::renewAction',));
        }
        not_flair_user_invitation_renew:

        if (0 === strpos($pathinfo, '/invitation/re')) {
            // flair_user_invitation_refuse
            if (0 === strpos($pathinfo, '/invitation/refuse') && preg_match('#^/invitation/refuse/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_flair_user_invitation_refuse;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'flair_user_invitation_refuse')), array (  '_controller' => 'Flair\\UserBundle\\Controller\\InvitationController::refuseAction',));
            }
            not_flair_user_invitation_refuse:

            // flair_user_invitation_remove
            if (0 === strpos($pathinfo, '/invitation/remove') && preg_match('#^/invitation/remove/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_flair_user_invitation_remove;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'flair_user_invitation_remove')), array (  '_controller' => 'Flair\\UserBundle\\Controller\\InvitationController::removeAction',));
            }
            not_flair_user_invitation_remove:

        }

        if (0 === strpos($pathinfo, '/mes-services')) {
            // flair_user_service_list
            if ($pathinfo === '/mes-services') {
                return array (  '_controller' => 'Flair\\UserBundle\\Controller\\ServicesController::listerAction',  '_route' => 'flair_user_service_list',);
            }

            // flair_user_service_see
            if (preg_match('#^/mes\\-services/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_flair_user_service_see;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'flair_user_service_see')), array (  '_controller' => 'Flair\\UserBundle\\Controller\\ServicesController::afficherAction',));
            }
            not_flair_user_service_see:

            // flair_user_service_edit
            if (preg_match('#^/mes\\-services/(?P<id>\\d+)/modifier$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_flair_user_service_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'flair_user_service_edit')), array (  '_controller' => 'Flair\\UserBundle\\Controller\\ServicesController::modifierAction',));
            }
            not_flair_user_service_edit:

        }

        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // login
                if ($pathinfo === '/login') {
                    return array (  '_controller' => 'Flair\\UserBundle\\Controller\\SecurityController::loginAction',  '_route' => 'login',);
                }

                // login_check
                if ($pathinfo === '/login_check') {
                    return array('_route' => 'login_check');
                }

            }

            // logout
            if ($pathinfo === '/logout') {
                return array('_route' => 'logout');
            }

        }

        if (0 === strpos($pathinfo, '/ajax')) {
            if (0 === strpos($pathinfo, '/ajax/inscription')) {
                // Categories_inscription_organisme
                if ($pathinfo === '/ajax/inscription/organisme/categories') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_Categories_inscription_organisme;
                    }

                    return array (  '_controller' => 'Flair\\UserBundle\\Controller\\CategoriesController::inscriptionOrganismeAction',  '_route' => 'Categories_inscription_organisme',);
                }
                not_Categories_inscription_organisme:

                // Categories_inscription_prestataire
                if ($pathinfo === '/ajax/inscription/prestataire/categories') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_Categories_inscription_prestataire;
                    }

                    return array (  '_controller' => 'Flair\\UserBundle\\Controller\\CategoriesController::inscriptionPrestataireAction',  '_route' => 'Categories_inscription_prestataire',);
                }
                not_Categories_inscription_prestataire:

            }

            // Categories_creation_consultation
            if ($pathinfo === '/ajax/creation-demande/categories') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_Categories_creation_consultation;
                }

                return array (  '_controller' => 'Flair\\UserBundle\\Controller\\CategoriesController::creationConsultationAction',  '_route' => 'Categories_creation_consultation',);
            }
            not_Categories_creation_consultation:

            if (0 === strpos($pathinfo, '/ajax/mo')) {
                if (0 === strpos($pathinfo, '/ajax/mon-profil')) {
                    // Categories_profil_organisme
                    if ($pathinfo === '/ajax/mon-profil/organisme/categories') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_Categories_profil_organisme;
                        }

                        return array (  '_controller' => 'Flair\\UserBundle\\Controller\\CategoriesController::modificationProfilOrganismeAction',  '_route' => 'Categories_profil_organisme',);
                    }
                    not_Categories_profil_organisme:

                    // Categories_profil_prestataire
                    if ($pathinfo === '/ajax/mon-profil/prestataire/categories') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_Categories_profil_prestataire;
                        }

                        return array (  '_controller' => 'Flair\\UserBundle\\Controller\\CategoriesController::modificationProfilPrestataireAction',  '_route' => 'Categories_profil_prestataire',);
                    }
                    not_Categories_profil_prestataire:

                }

                // Categories_modification_consultation
                if ($pathinfo === '/ajax/modification-demande/categories') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_Categories_modification_consultation;
                    }

                    return array (  '_controller' => 'Flair\\UserBundle\\Controller\\CategoriesController::modificationConsultationAction',  '_route' => 'Categories_modification_consultation',);
                }
                not_Categories_modification_consultation:

            }

        }

        // Prestataire_inscription
        if (0 === strpos($pathinfo, '/invitation') && preg_match('#^/invitation/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_Prestataire_inscription;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'Prestataire_inscription')), array (  '_controller' => 'FlairPrestataireBundle:Inscription:inscription',));
        }
        not_Prestataire_inscription:

        if (0 === strpos($pathinfo, '/mes-')) {
            if (0 === strpos($pathinfo, '/mes-propositions')) {
                // Prestataire_propositions
                if ($pathinfo === '/mes-propositions') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_Prestataire_propositions;
                    }

                    return array (  '_controller' => 'Flair\\PrestataireBundle\\Controller\\ReponsesController::listerAction',  '_route' => 'Prestataire_propositions',);
                }
                not_Prestataire_propositions:

                // Prestataire_propositions_afficher
                if (preg_match('#^/mes\\-propositions/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Prestataire_propositions_afficher')), array (  '_controller' => 'Flair\\PrestataireBundle\\Controller\\ReponsesController::afficherAction',));
                }

                // Prestataire_propositions_questions_lister
                if (preg_match('#^/mes\\-propositions/(?P<id>[^/]++)/questions/lister$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Prestataire_propositions_questions_lister')), array (  '_controller' => 'Flair\\PrestataireBundle\\Controller\\QuestionsController::listerAction',));
                }

                // Prestataire_propositions_questions_poser
                if (preg_match('#^/mes\\-propositions/(?P<id>[^/]++)/questions/poser$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Prestataire_propositions_questions_poser')), array (  '_controller' => 'Flair\\PrestataireBundle\\Controller\\QuestionsController::poserAction',));
                }

                // Prestataire_propositions_questions_afficher
                if (preg_match('#^/mes\\-propositions/(?P<id>[^/]++)/questions/afficher$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Prestataire_propositions_questions_afficher')), array (  '_controller' => 'Flair\\PrestataireBundle\\Controller\\QuestionsController::afficherAction',));
                }

                // Prestataire_propositions_etape_one
                if (preg_match('#^/mes\\-propositions/(?P<id>[^/]++)/etape1$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Prestataire_propositions_etape_one')), array (  '_controller' => 'Flair\\PrestataireBundle\\Controller\\ReponsesController::etapeOneAction',));
                }

                // Prestataire_propositions_etape_two_saisie
                if (preg_match('#^/mes\\-propositions/(?P<id>[^/]++)/etape2/saisie$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Prestataire_propositions_etape_two_saisie')), array (  '_controller' => 'Flair\\PrestataireBundle\\Controller\\ReponsesController::etapeTwoSaisieAction',));
                }

                // Prestataire_propositions_etape_two_documents
                if (preg_match('#^/mes\\-propositions/(?P<id>[^/]++)/etape2/documents$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Prestataire_propositions_etape_two_documents')), array (  '_controller' => 'Flair\\PrestataireBundle\\Controller\\ReponsesController::etapeTwoDocumentsAction',));
                }

                // Prestataire_propositions_etape_three
                if (preg_match('#^/mes\\-propositions/(?P<id>[^/]++)/etape3$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Prestataire_propositions_etape_three')), array (  '_controller' => 'Flair\\PrestataireBundle\\Controller\\ReponsesController::etapeThreeAction',));
                }

                // Prestataire_propositions_etape_three_supprimer_document
                if (preg_match('#^/mes\\-propositions/(?P<idReponse>[^/]++)/etape3/supprimer\\-document/(?P<idDocument>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Prestataire_propositions_etape_three_supprimer_document')), array (  '_controller' => 'Flair\\PrestataireBundle\\Controller\\ReponsesController::etapeThreeSupprimerAction',));
                }

                // Prestataire_propositions_etape_four
                if (preg_match('#^/mes\\-propositions/(?P<id>[^/]++)/etape4$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Prestataire_propositions_etape_four')), array (  '_controller' => 'Flair\\PrestataireBundle\\Controller\\ReponsesController::etapeFourAction',));
                }

                // Prestataire_propositions_envoyer_demande
                if (preg_match('#^/mes\\-propositions/(?P<id>[^/]++)/envoyer$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Prestataire_propositions_envoyer_demande')), array (  '_controller' => 'Flair\\PrestataireBundle\\Controller\\ReponsesController::envoyerAction',));
                }

                // Prestataire_propositions_debuter
                if (preg_match('#^/mes\\-propositions/(?P<id>[^/]++)/debuter$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Prestataire_propositions_debuter')), array (  '_controller' => 'Flair\\PrestataireBundle\\Controller\\ReponsesController::debuterAction',));
                }

                // Prestataire_propositions_terminer
                if (preg_match('#^/mes\\-propositions/(?P<id>[^/]++)/terminer$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Prestataire_propositions_terminer')), array (  '_controller' => 'Flair\\PrestataireBundle\\Controller\\ReponsesController::terminerAction',));
                }

                // Prestataire_proposition_annuler
                if (preg_match('#^/mes\\-propositions/(?P<id>[^/]++)/annuler$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Prestataire_proposition_annuler')), array (  '_controller' => 'Flair\\PrestataireBundle\\Controller\\ReponsesController::annulerAction',));
                }

            }

            // Organisme_consultations
            if ($pathinfo === '/mes-consultations') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_Organisme_consultations;
                }

                return array (  '_controller' => 'Flair\\OrganismeBundle\\Controller\\ConsultationsController::listerAction',  '_route' => 'Organisme_consultations',);
            }
            not_Organisme_consultations:

        }

        if (0 === strpos($pathinfo, '/demandes')) {
            // Organisme_consultation_questions
            if (preg_match('#^/demandes/(?P<id>[^/]++)/questions$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_Organisme_consultation_questions;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'Organisme_consultation_questions')), array (  '_controller' => 'Flair\\OrganismeBundle\\Controller\\QuestionsController::listerAction',));
            }
            not_Organisme_consultation_questions:

            // Organisme_consultation_questions_afficher
            if (0 === strpos($pathinfo, '/demandes/questions') && preg_match('#^/demandes/questions/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_Organisme_consultation_questions_afficher;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'Organisme_consultation_questions_afficher')), array (  '_controller' => 'Flair\\OrganismeBundle\\Controller\\QuestionsController::afficherAction',));
            }
            not_Organisme_consultation_questions_afficher:

        }

        if (0 === strpos($pathinfo, '/creation-demande')) {
            if (0 === strpos($pathinfo, '/creation-demande/etape-')) {
                if (0 === strpos($pathinfo, '/creation-demande/etape-1')) {
                    // Organisme_creation_consultation_etape1_modifier
                    if (preg_match('#^/creation\\-demande/etape\\-1/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                            goto not_Organisme_creation_consultation_etape1_modifier;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'Organisme_creation_consultation_etape1_modifier')), array (  '_controller' => 'Flair\\OrganismeBundle\\Controller\\ConsultationsController::modifierEtape1Action',));
                    }
                    not_Organisme_creation_consultation_etape1_modifier:

                    // Organisme_creation_consultation_etape1
                    if ($pathinfo === '/creation-demande/etape-1') {
                        if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                            goto not_Organisme_creation_consultation_etape1;
                        }

                        return array (  '_controller' => 'Flair\\OrganismeBundle\\Controller\\ConsultationsController::creationEtape1Action',  '_route' => 'Organisme_creation_consultation_etape1',);
                    }
                    not_Organisme_creation_consultation_etape1:

                }

                // Organisme_creation_consultation_etape2
                if (0 === strpos($pathinfo, '/creation-demande/etape-2') && preg_match('#^/creation\\-demande/etape\\-2/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_Organisme_creation_consultation_etape2;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Organisme_creation_consultation_etape2')), array (  '_controller' => 'Flair\\OrganismeBundle\\Controller\\ConsultationsController::creationEtape2Action',));
                }
                not_Organisme_creation_consultation_etape2:

                // Organisme_creation_consultation_etape3
                if (0 === strpos($pathinfo, '/creation-demande/etape-3') && preg_match('#^/creation\\-demande/etape\\-3/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_Organisme_creation_consultation_etape3;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Organisme_creation_consultation_etape3')), array (  '_controller' => 'Flair\\OrganismeBundle\\Controller\\ConsultationsController::creationEtape3Action',));
                }
                not_Organisme_creation_consultation_etape3:

            }

            // Organisme_suppression_document_etape3
            if (0 === strpos($pathinfo, '/creation-demande/documents/supprimer') && preg_match('#^/creation\\-demande/documents/supprimer/(?P<idConsultation>[^/]++)/(?P<idDocument>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'Organisme_suppression_document_etape3')), array (  '_controller' => 'Flair\\OrganismeBundle\\Controller\\ConsultationsController::supprimerDocumentAction',));
            }

        }

        if (0 === strpos($pathinfo, '/demandes')) {
            if (0 === strpos($pathinfo, '/demandes/publier')) {
                // Organisme_consultation_publier
                if (preg_match('#^/demandes/publier/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_Organisme_consultation_publier;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Organisme_consultation_publier')), array (  '_controller' => 'Flair\\OrganismeBundle\\Controller\\ConsultationsController::publierAction',));
                }
                not_Organisme_consultation_publier:

                // Organisme_consultation_publier_post
                if (preg_match('#^/demandes/publier/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_Organisme_consultation_publier_post;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Organisme_consultation_publier_post')), array (  '_controller' => 'Flair\\OrganismeBundle\\Controller\\ConsultationsController::postPublierAction',));
                }
                not_Organisme_consultation_publier_post:

                // Organisme_consultation_publier_filtrer
                if (preg_match('#^/demandes/publier/(?P<id>[^/]++)/filtrer$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_Organisme_consultation_publier_filtrer;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Organisme_consultation_publier_filtrer')), array (  '_controller' => 'Flair\\OrganismeBundle\\Controller\\ConsultationsController::publierFiltrerAction',));
                }
                not_Organisme_consultation_publier_filtrer:

            }

            // Organisme_consultation_annuler
            if (0 === strpos($pathinfo, '/demandes/annuler') && preg_match('#^/demandes/annuler/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'Organisme_consultation_annuler')), array (  '_controller' => 'Flair\\OrganismeBundle\\Controller\\ConsultationsController::annulerAction',));
            }

            // Organisme_consultation_selectionner
            if (0 === strpos($pathinfo, '/demandes/reponses') && preg_match('#^/demandes/reponses/(?P<id>[^/]++)/selectionner$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_Organisme_consultation_selectionner;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'Organisme_consultation_selectionner')), array (  '_controller' => 'Flair\\OrganismeBundle\\Controller\\ConsultationsController::selectionnerAction',));
            }
            not_Organisme_consultation_selectionner:

            // Organisme_consultation_reponses
            if (preg_match('#^/demandes/(?P<id>[^/]++)/reponses$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'Organisme_consultation_reponses')), array (  '_controller' => 'Flair\\OrganismeBundle\\Controller\\ReponsesController::listerAction',));
            }

            if (0 === strpos($pathinfo, '/demandes/reponse')) {
                // Organisme_consultation_reponse
                if (preg_match('#^/demandes/reponse/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Organisme_consultation_reponse')), array (  '_controller' => 'Flair\\OrganismeBundle\\Controller\\ReponsesController::afficherAction',));
                }

                // Organisme_consultation_reponse_selectionner_post
                if (0 === strpos($pathinfo, '/demandes/reponses') && preg_match('#^/demandes/reponses/(?P<id>[^/]++)/selectionnerPost$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Organisme_consultation_reponse_selectionner_post')), array (  '_controller' => 'Flair\\OrganismeBundle\\Controller\\ReponsesController::selectionnerPostAction',));
                }

            }

        }

        if (0 === strpos($pathinfo, '/mes-prestataires')) {
            // Organisme_prestataire
            if (preg_match('#^/mes\\-prestataires/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_Organisme_prestataire;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'Organisme_prestataire')), array (  '_controller' => 'Flair\\OrganismeBundle\\Controller\\PrestatairesController::afficherAction',));
            }
            not_Organisme_prestataire:

            // Organisme_prestataires
            if ($pathinfo === '/mes-prestataires') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_Organisme_prestataires;
                }

                return array (  '_controller' => 'Flair\\OrganismeBundle\\Controller\\PrestatairesController::listerAction',  '_route' => 'Organisme_prestataires',);
            }
            not_Organisme_prestataires:

            // Organisme_prestataires_supprimer
            if (0 === strpos($pathinfo, '/mes-prestataires/supprimerPrestataire') && preg_match('#^/mes\\-prestataires/supprimerPrestataire/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'Organisme_prestataires_supprimer')), array (  '_controller' => 'Flair\\OrganismeBundle\\Controller\\PrestatairesController::supprimerPrestataireAction',));
            }

        }

        // Homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'Homepage');
            }

            return array (  '_controller' => 'Flair\\CoreBundle\\Controller\\HomepageController::indexAction',  '_route' => 'Homepage',);
        }

        // Inscription
        if ($pathinfo === '/inscription') {
            return array (  '_controller' => 'Flair\\CoreBundle\\Controller\\HomepageController::inscriptionAction',  '_route' => 'Inscription',);
        }

        // FAQ
        if ($pathinfo === '/faq') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_FAQ;
            }

            return array (  '_controller' => 'Flair\\CoreBundle\\Controller\\HomepageController::faqAction',  '_route' => 'FAQ',);
        }
        not_FAQ:

        // Mentions_legales
        if ($pathinfo === '/mentions-legales') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_Mentions_legales;
            }

            return array (  '_controller' => 'Flair\\CoreBundle\\Controller\\HomepageController::mentionsLegalesAction',  '_route' => 'Mentions_legales',);
        }
        not_Mentions_legales:

        // Inscription_prestataire
        if ($pathinfo === '/inscription/prestataire') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_Inscription_prestataire;
            }

            return array (  '_controller' => 'Flair\\CoreBundle\\Controller\\HomepageController::inscriptionPrestataireAction',  '_route' => 'Inscription_prestataire',);
        }
        not_Inscription_prestataire:

        // fos_js_routing_js
        if (0 === strpos($pathinfo, '/js/routing') && preg_match('#^/js/routing(?:\\.(?P<_format>js|json))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_js_routing_js')), array (  '_controller' => 'fos_js_routing.controller:indexAction',  '_format' => 'js',));
        }

        if (0 === strpos($pathinfo, '/admin')) {
            // sonata_admin_redirect
            if (rtrim($pathinfo, '/') === '/admin') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'sonata_admin_redirect');
                }

                return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => 'sonata_admin_dashboard',  'permanent' => 'true',  '_route' => 'sonata_admin_redirect',);
            }

            // sonata_admin_dashboard
            if ($pathinfo === '/admin/dashboard') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::dashboardAction',  '_route' => 'sonata_admin_dashboard',);
            }

            if (0 === strpos($pathinfo, '/admin/core')) {
                // sonata_admin_retrieve_form_element
                if ($pathinfo === '/admin/core/get-form-field-element') {
                    return array (  '_controller' => 'sonata.admin.controller.admin:retrieveFormFieldElementAction',  '_route' => 'sonata_admin_retrieve_form_element',);
                }

                // sonata_admin_append_form_element
                if ($pathinfo === '/admin/core/append-form-field-element') {
                    return array (  '_controller' => 'sonata.admin.controller.admin:appendFormFieldElementAction',  '_route' => 'sonata_admin_append_form_element',);
                }

                // sonata_admin_short_object_information
                if (0 === strpos($pathinfo, '/admin/core/get-short-object-description') && preg_match('#^/admin/core/get\\-short\\-object\\-description(?:\\.(?P<_format>html|json))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_admin_short_object_information')), array (  '_controller' => 'sonata.admin.controller.admin:getShortObjectDescriptionAction',  '_format' => 'html',));
                }

                // sonata_admin_set_object_field_value
                if ($pathinfo === '/admin/core/set-object-field-value') {
                    return array (  '_controller' => 'sonata.admin.controller.admin:setObjectFieldValueAction',  '_route' => 'sonata_admin_set_object_field_value',);
                }

            }

            // sonata_admin_search
            if ($pathinfo === '/admin/search') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::searchAction',  '_route' => 'sonata_admin_search',);
            }

            // sonata_admin_retrieve_autocomplete_items
            if ($pathinfo === '/admin/core/get-autocomplete-items') {
                return array (  '_controller' => 'sonata.admin.controller.admin:retrieveAutocompleteItemsAction',  '_route' => 'sonata_admin_retrieve_autocomplete_items',);
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
