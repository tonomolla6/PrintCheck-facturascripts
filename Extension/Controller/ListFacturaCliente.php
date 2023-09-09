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

namespace FacturaScripts\Plugins\PrintChecker\Extension\Controller;

use FacturaScripts\Core\Model\FacturaCliente;

/**
 * Description of ListFacturaCliente.
 *
 * @author Tono Mollá González <mail@tonomolla.es>
 */
class ListFacturaCliente
{
    protected function execPreviousAction()
    {
        return function ($action) {
            if ($action === 'export' && $_POST['option'] == 'PDF') {
                foreach ($_POST['code'] as $id) {
                    $factura = new FacturaCliente();
                    $factura->loadFromCode($id);
                    $factura->printed = true;
                    $factura->save();
                }
            }
        };
    }
}
