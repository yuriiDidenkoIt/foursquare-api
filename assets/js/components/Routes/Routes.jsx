import React, { Suspense, lazy } from 'react';
import { Switch, Route } from 'react-router-dom';
import routes from '@Config/routes';
import Loader from '@Components/Loader';
const Home = lazy(() => import('@Components/Home'));
const Categories = lazy(() => import('@Components/Categories'));
const ExploreCategory = lazy(() => import('@Components/ExploreCategory'));
const SubCategories = lazy(() => import('@Components/SubCategories'));

const Routes = () => (
    <Suspense fallback={<Loader />}>
        <Switch>
            <Route exact path={routes.home.path}>
                <Home />
            </Route>
            <Route exact path={routes.categories.path}>
                <Categories />
            </Route>
            <Route exact path={`${routes.explore.path}/:${routes.explore.parameter}`}>
                <ExploreCategory />
            </Route>
            <Route exact path={`${routes.subCategories.path}/:${routes.subCategories.parameter}`}>
                <SubCategories />
            </Route>
        </Switch>
    </Suspense>
);

export default Routes;