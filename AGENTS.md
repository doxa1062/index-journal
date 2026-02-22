# AGENTS.md

This file defines guardrails for agents working in `index-journal`.

## Project Snapshot
- Stack: Kirby CMS (PHP), Tailwind CSS, small vanilla JS/jQuery assets.
- Tailwind source: `src/css/tailwind.css`.
- Tailwind build output: `assets/css/tailwind.css`.
- Main app code lives in `site/`, `assets/`, and `src/`.

## Non-Negotiable Rules
1. Use Tailwind for styling wherever possible.
2. Prefer Tailwind utility classes in templates/snippets over new custom CSS.
3. Do not hand-edit `assets/css/tailwind.css`; regenerate it via build commands.
4. Treat `src/css/legacy.css` as legacy compatibility only. Add new rules there only when Tailwind cannot reasonably express the requirement, and keep additions minimal.
5. Do not edit third-party/framework code in `vendor/` or `kirby/` unless explicitly requested.
6. Never commit secrets or API keys. Keep credentials in environment variables (`.env`, `.env.local`) and reference via `env()`.
7. Escape dynamic output in templates (`esc()`, `html()`, `->esc()`, `->html()`) unless trusted HTML is explicitly intended.

## Styling Guardrails
- Tailwind-first decision order:
  1. Existing utility classes
  2. Tailwind theme tokens in `tailwind.config.js`
  3. Small reusable component classes in Tailwind source
  4. Legacy CSS fallback (last resort)
- Reuse existing theme tokens (`paper`, `ink`, `mist`, `charcoal`, font sizes, spacing, breakpoints) before adding new ones.
- Keep visual changes responsive and verify mobile breakpoints (`menu`, `mobile`, `narrow`, `xs`, `lg`).

## PHP/Kirby Guardrails
- Keep templates focused on rendering; move complex logic into snippets/helpers/controllers when practical.
- Reuse snippets for repeated markup.
- Preserve Kirby content model expectations (`content/`, blueprints, templates, snippets naming consistency).
- Avoid breaking route behavior in `site/config/config.php` without validating downstream URLs and integrations.

## Change Boundaries
- Safe to modify:
  - `site/templates/**`
  - `site/snippets/**`
  - `site/plugins/**` (project/plugin code only)
  - `src/css/**`
  - `assets/js/**`
- Avoid modifying generated or external assets unless needed for the task.

## Verification Checklist (Before Hand-off)
1. Run Tailwind build after style changes: `npm run build`.
2. For PHP changes, lint touched files: `php -l path/to/file.php`.
3. Smoke-test key pages locally (home, issue, essay, and any changed template path).
4. Confirm no unintended edits in `vendor/`, `kirby/`, or generated artifacts.

## Delivery Expectations
- Keep diffs focused and minimal.
- Document any unavoidable legacy CSS additions and why Tailwind was insufficient.
- If a task requires tradeoffs (performance, accessibility, or schema/SEO behavior), call them out explicitly in the hand-off notes.
