import React from 'react';
import { NavLink, useLocation } from 'react-router-dom';
import classnames from 'classnames';
import routes from '@Config/routes';
import { isActiveRoute } from '@Utils/navigation';

import './Nav.scss';

const Nav = () => {
    const location = useLocation();

    return (
        <nav>
            <ul className="nav">
                <li className={classnames('nav-item', { active: isActiveRoute(routes.home.path, location.pathname) })}>
                    <NavLink to={routes.home.path}>{routes.home.label}</NavLink>
                </li>
                <li className={classnames('nav-item', { active: isActiveRoute(routes.categories.path, location.pathname) })}>
                    <NavLink to={routes.categories.path}>{routes.categories.label}</NavLink>
                </li>
            </ul>
        </nav>
    );
}

export default Nav;