<?php
session_start();

if (isset($_SESSION['dataHistory'])) {
    $_SESSION['dataHistory'] = array();
}

echo "<table class=\"resultTable\">
                    <tr class=\"resultTableHeaderLine\">
                        <td class=\"resultTableColumnHeader\">
                            X
                        </td>
                        <td class=\"resultTableColumnHeader\">
                            Y
                        </td>
                        <td class=\"resultTableColumnHeader\">
                            R
                        </td>
                        <td class=\"resultTableColumnHeader\">
                            CURRENT TIME
                        </td>
                        <td class=\"resultTableColumnHeader\">
                            EXECUTION TIME
                        </td>
                        <td class=\"resultTableColumnHeader\">
                            HIT RESULT
                        </td>
                    </tr>
                </table>";

