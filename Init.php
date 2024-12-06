<?php
/**
 * This file is part of PrintChecker plugin for FacturaScripts.
 * Copyright (C) 2022-2025 Tono Mollá González <hola@tonomolla.es>.
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
 * @author Tono Mollá González <hola@tonomolla.es>
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
        
        // Nuevos controllers
        $this->loadExtension(new Extension\Controller\EditPedidoCliente());
        $this->loadExtension(new Extension\Controller\EditPresupuestoCliente());
        $this->loadExtension(new Extension\Controller\ListPedidoCliente());
        $this->loadExtension(new Extension\Controller\ListPresupuestoCliente());

        // Models
        $this->loadExtension(new Extension\Model\FacturaCliente());
        
        // Nuevos models
        $this->loadExtension(new Extension\Model\PedidoCliente());
        $this->loadExtension(new Extension\Model\PresupuestoCliente());
    }

    public function update()
    {
        // Actualizar opciones existentes
        $where = [
            new DataBaseWhere('name', 'EditFacturaCliente,EditAlbaranCliente,ListFacturaCliente,ListAlbaranCliente,EditPedidoCliente,EditPresupuestoCliente,ListPedidoCliente,ListPresupuestoCliente', 'IN'),
        ];
        
        foreach ((new PageOption())->all($where) as $pageOption) {
            $columns = json_decode($pageOption->columns, true) ?? [];
            
            // Verificar si ya existe la columna printed
            $hasPrinted = false;
            if (!empty($columns)) {
                foreach ($columns as $column) {
                    if (isset($column['name']) && $column['name'] === 'printed') {
                        $hasPrinted = true;
                        break;
                    }
                }
            }
            
            // Añadir la columna printed si no existe
            if (!$hasPrinted) {
                $columns[] = [
                    'name' => 'printed',
                    'order' => '285',
                    'display' => 'center',
                    'widget' => [
                        'type' => 'checkbox',
                        'fieldname' => 'printed'
                    ]
                ];
                
                $pageOption->columns = json_encode($columns);
                $pageOption->save();
            }
        }
    }
}