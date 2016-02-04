

{foreach item=itemC key=keyC from=$item->getChildren()}
    <tr class="treegrid-{$itemC->getId()} {$itemC->getType()} treegrid-parent-{$item->getId()}  {if $itemC->getCanDelete()}draggable droppable{/if}" data-id ="{$itemC->getId()}" >
        <td><img src="{$itemC->getTypeImage()}"/> {$itemC->getName()} </td><td> {if $itemC->getCanEdit() && $itemC->getCanDelete()}<span class="fa fa-pencil editItem" title="Editieren"></span> {/if} {if $itemC->getCanChildAdd()} <span class="fa fa-plus addItem"  title="Hinzufügen"></span> {/if}{if $itemC->getCanDelete()}<span class="fa fa-trash deleteItem " title="Löschen"></span>  <span class="fa fa-random moveItem"  title="Verschieben"></span> {/if}{if $itemC->getCanAddContent()} <span class="fa fa-file addContent"  title="Inhalt hinzufügen"></span> {/if}</td>
    </tr>
    {include file="templates/controls/treegrid/treegriditem.tpl" item=$itemC}
{/foreach}