<?php
/**
 * This file is part of PrintChecker plugin for FacturaScripts
 * Copyright (C) 2022-2023 Tono Mollá González <mail@tonomolla.es>.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace FacturaScripts\Plugins\PrintChecker;

use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Core\Base\InitClass;
use FacturaScripts\Core\Model\PageOption;

/**
 * Description of Init.
 *
 * @author Tono Mollá González <mail@tonomolla.es>
 */
class Init extends InitClass
{
    public function init()
    {
        // Controllers
        $this->loadExtension(new Extension\Controller\EditFacturaCliente());
        $this->loadExtension(new Extension\Controller\EditAlbaranCliente());
        $this->loadExtension(new Extension\Controller\ListFacturaCliente());
        $this->loadExtension(new Extension\Controller\ListAlbaranCliente());

        // Models
        $this->loadExtension(new Extension\Model\FacturaCliente());
    }

    public function update()
    {
        // Delete old options
        $where = [
            new DataBaseWhere('name', 'EditFacturaCliente,EditAlbaranCliente,ListFacturaCliente,ListAlbaranCliente', 'IN'),
        ];
        foreach ((new PageOption())->all($where) as $value) {
            $value->delete();
        }
    }
}
