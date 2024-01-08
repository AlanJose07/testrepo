<? /* Overriding OpenLogin's view */ ?>

<div id="rn_<?= $this->instanceID ?>" class="<?= $this->classList ?>">
    <rn:block id="top"/>
    <rn:block id="preServiceButton"/>
    <a href="javascript:void(0)" id="rn_<?= $this->instanceID ?>_ProviderButton" class="rn_Hidden rn_LoginProvider rn_<?= $this->data['attrs']['label_service_button'] ?>"><?= $this->data['attrs']['label_service_button'] ?></a>
    <rn:block id="postServiceButton"/>
<? if (!$this->data['attrs']['one_click_access_enabled']): ?>
    <div id="rn_<?= $this->instanceID ?>_ActionArea" class="rn_ActionArea" aria-live="assertive">
        <rn:block id="preForm"/>
        <form id="rn_<?= $this->instanceID ?>_Info" class="rn_OpenLoginForm <?= ($this->data['attrs']['openid']) ? 'rn_OpenIDForm' : 'rn_OAuthForm' ?>" onsubmit="return false;">
            <rn:block id="formTop"/>
        <? if ($this->data['attrs']['openid']): ?>
            <rn:block id="preOpenIDLabel"/>
            <label for="rn_<?= $this->instanceID ?>_ProviderUrl" class="rn_ScreenReaderOnly">#rn:msg:ENTER_YOUR_OPENID_PROVIDER_URL_LBL#</label>
            <rn:block id="postOpenIDLabel"/>
            <rn:block id="preOpenIDInput"/>
            <input id="rn_<?= $this->instanceID ?>_ProviderUrl" type="text" autocorrect="off" autocapitalize="off" value="<?= $this->data['attrs']['openid_placeholder'] ?>"/>
            <rn:block id="postOpenIDInput"/>
        <? endif; ?>
            <rn:block id="preSubmitButton"/>
            <input type="submit" id="rn_<?= $this->instanceID ?>_LoginButton" aria-labelledby="rn_<?= $this->instanceID ?>_LoginButtonLabel" class="sign_in_akamai" value="Se connecter"/>
            <rn:block id="postSubmitButton"/>
            <rn:block id="formBottom"/>
        </form>
        <rn:block id="postForm"/>
    </div>
<? endif; ?>
    <rn:block id="bottom"/>
</div>
