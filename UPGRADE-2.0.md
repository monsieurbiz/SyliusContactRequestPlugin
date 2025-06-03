# UPGRADE FROM `1.2` TO `2.0`

- Service controller has changed from `sylius.controller.shop.contact` to `sylius_shop.controller.contact`, particularly in the `sylius_shop_contact_request` route in `config/routes/sylius_shop_contact_request_override.yaml`.
- Template path has changed from `@MonsieurBizSyliusContactRequestPlugin/Shop/ContactRequest/request.html.twig` to `@MonsieurBizSyliusContactRequestPlugin/shop/contact/contact_request.html.twig`, particularly in the `sylius_shop_contact_request` route in `config/routes/sylius_shop_contact_request_override.yaml`.
- Replace translation prefix from `monsieurbiz.contact_request.` to `monsieurbiz_contact_request.` for the context "messages".
- Replace translation prefix from `monsieurbiz.contact_request.` to `monsieurbiz_contact_request.contact.` for the context "validators".
